<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepo;

class PublicCategoryController extends Controller
{
    protected CategoryRepo $cateoryRepo;

    public function __construct(CategoryRepo $cateoryRepo)
    {
        $this->cateoryRepo = $cateoryRepo;
    }

    public function index()
    {
        $categories = $this->cateoryRepo->getAll();
        return $categories->pluck('name');
    }
}
