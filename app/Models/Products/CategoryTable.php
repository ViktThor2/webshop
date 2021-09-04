<?php

namespace App\Models\Products;

class CategoryTable
{
    public function getColumns()
    {
        $mainCategories = MainCategory::all();

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