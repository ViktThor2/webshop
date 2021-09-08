<?php

namespace App\Models\Products;

class CategoryTable
{
    public function getColumns()
    {
        $mainCategories = MainCategory::all();
        
        if(count($mainCategories) == 0) return [];

        foreach($mainCategories as $mainCategory):
            $category = new Category();
            $category->setData($mainCategory);
            $categories[] = $category;
            
            foreach($mainCategory->sub_categories as $subCategory):
                $category = new Category();
                $category->setData($mainCategory, $subCategory);
                $categories[] = $category;
            endforeach; 

        endforeach;
        
        return $categories;
    }


}