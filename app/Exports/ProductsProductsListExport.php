<?php 

namespace App\Exports;
use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ProductsProductsListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Products::exportProductsListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Name',
			'Category',
			'Aval Qty',
			'Selling Price',
			'Purchase Price',
			'Unit'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->name,
			$record->category,
			$record->qty,
			$record->selling_price,
			$record->purchase_price,
			$record->unit
        ];
    }
}
