<?php

namespace App\Http\Controllers;

use App\Repositories\SupplierRepo;

class PublicSupplierController extends Controller
{
    protected SupplierRepo $supplierRepo;

    public function __construct(SupplierRepo $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function index()
    {
        $suppliers = $this->supplierRepo->getAll();
        return $suppliers->pluck('name');
    }
}
