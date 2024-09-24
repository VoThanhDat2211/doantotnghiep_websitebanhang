<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductRepository 
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update(array $data, $product)
    {
        return $product->update($data);
    }

    public function delete($product)
    {
        return $product->delete();
    }

    public function getProducts()
    {
        return $this->product->paginate(30);
    }

    public function getProductsWithProductVariants()
    {
        return $this->product->with('productVariants')->get();
    }

    public function getByIdWithImage($id)
    {
        return $this->product->with('imageProducts')->find($id);
    }


    public function existsProductName($productName)
    {
        return $this->product->where('name',$productName)->exists();
    }

    public function getById($id)
    {
        return  $this->product->find($id);
    }

    public function getByIdWithProductVariants($id)
    {
        return $this->product->with('productVariants')->find($id);
    }

    public function getByCategories(array $categoryIds)
    {
        return  Product::whereIn('category_id', $categoryIds)->paginate(16);
    }

    public function getByCategoriesAndName(array $categoryIds, $productName)
    {
        return Product::whereIn('category_id', $categoryIds)->where('name','like','%' . $productName . '%')->paginate(16);
    } 

    public function getByCategory($categoryId)
    {
        return $this->product->where('category_id', $categoryId)->paginate(16);
    }

    public function getTopProductOrderByMonth($yearNow, $monthNow, $status)
    {
        $query = DB::table('products as p')
            ->select('p.name', DB::raw('SUM(order) as total_quantity_by_product'))
            ->join('product_variants as pv', 'on','p.id = pv.product_id')
            ->join('order_lines as ol','on', 'pv.id = ol.product_variant_id')
            ->join('orders as o', function ($join, $status, $yearNow, $monthNow) {
                $join->on('ol.order_id', '=', 'o.id');
                $join->where('status', $status);
                $join->whereYear('created_at', $yearNow);
                $join->whereMonth('created_at', $monthNow);
            })
            ->groupBy('p.id')
            ->orderByDesc('total_quantity_by_product')
            ->limit(5)
            ->get();

        return $query;
    }

    public function getTopProductRevenueByMonth($yearNow, $monthNow, $status)
    {
        $query = DB::table('products as p')
            ->select('p.name', DB::raw('SUM(subquery.total_price) as total_price_by_product'))
            ->join(DB::raw('(SELECT   ol.product_variant_id, sum((ol.quantity * ol.price)) AS total_price
               FROM order_lines ol
               INNER JOIN orders o ON ol.order_id = o.id
               WHERE YEAR(o.order_date) = ? AND MONTH(o.order_date) = ?  AND o.status = ? 
               GROUP BY ol.product_variant_id) AS subquery'), 'pv.id', '=', 'subquery.product_variant_id')
            ->setBindings([$yearNow, $monthNow, $status])
            ->groupBy('pv.product_id')
            ->orderByDesc('total_price_by_product')
            ->limit(5)
            ->get();

        return $query;
    }
}