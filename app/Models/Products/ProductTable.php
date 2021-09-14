<?php

namespace App\Models\Products;

class ProductTable extends Product
{
    public function getColumns()
    {
        $this->main_category_id = $this->main_category->name ??'';
        $this->sub_category_id = $this->sub_category->name ??'';
        $this->brand_id = $this->brand->name ??'';
        $this->qty .= ' ' .$this->amount_unit->name;
        $this->netto = number_format($this->netto, 2, ',', '.'). ' Ft';
        $this->brutto = number_format($this->brutto, 2, ',', '.'). ' Ft';
        $this->vat_sum = number_format($this->vat_sum, 2, ',', '.'). ' Ft (' .$this->vat_id. '%)';
        $this->image1 = $this->product_images[0]->image ??'';
        $this->image2  = $this->product_images[1]->image ??'';
        $this->image3  = $this->product_images[2]->image ??'';
        $this->image4  = $this->product_images[3]->image ??'';
    }

    public function getEditForm()
    {
        $mainCategories = MainCategory::all();
        $brands = Brand::all();
        $units = AmountUnit::all();
        $vats = Vat::all();

        $optionsMainCategories = '';
        $optionsSubCategories = '';
        $optionsBrands = '';
        $optionsUnits = '';
        $optionsVats = '';

        foreach($mainCategories as $mainCategory):
            if($mainCategory->id == $this->main_category_id) continue; 
            $optionsMainCategories.='<option value="'.$mainCategory->id.'">'
                                        .$mainCategory->name.
                                    '</option>';
        endforeach;

        foreach($this->main_category->sub_categories as $sub):
            if($sub->id == $this->sub_category_id) continue; 
            $optionsSubCategories.='<option value="'.$sub->id.'">'.$sub->name.'</option>';
        endforeach;
   
        foreach($brands as $brand):
            if($brand->id == $this->brand_id) continue; 
            $optionsBrands.='<option value="'.$brand->id.'">'.$brand->name.'</option>';
        endforeach;

        foreach($units as $unit):
            if($unit->id == $this->amount_unit_id) continue;
            $optionsUnits.='<option value="'.$unit->id.'">'.$unit->name.'</option>';
        endforeach;

        foreach($vats as $vat):
            if($vat->name == $this->vat_id) continue;
            $optionsVats.='<option value="'.$vat->name.'">'.$vat->name.' %</option>';
        endforeach;
        
        return '<div class="form-floating mb-2">
                    <input type="text" class="form-control" name="name" id="editName"
                             value="'.$this->name.'" required>
                    <label for="editName">Név</label>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control select2" name="vat_id" id="editVat_id" required>
                                <option value=""  selected>Válasszon ÁFÁ-t</option>
                                <option value="'.$this->vat_id.'" selected="selected">'.$this->vat_id.' %</option>
                                '.$optionsVats.'
                            </select>
                            <label for="editVat_id">Áfa</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="vat_sum" id="editVat_sum"
                                value="'.$this->vat_sum.'" placeholder="Áfa" disabled>
                            <label for="editVat_sum">Áfa</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="netto" id="editNetto" 
                                value="'.$this->netto.'" placeholder="Nettó" onkeyup="editBruttoCalc()" required>
                            <label for="editNetto">Nettó</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="brutto" id="editBrutto" 
                                value="'.$this->brutto.'" placeholder="Bruttó" onkeyup="editNettoCalc()" required>
                            <label for="editBrutto">Bruttó</label>
                        </div>
                    </div>
                </div>    
                <div class="form-floating mb-2">
                    <select class="form-control select2" data-dependent="editSub_category_id" name="editMain_category_id" id="editMain_category_id" required>
                        <option disabled>Kérem válasszon főkategóriát</option>
                        <option value="'.$this->main_category_id.'" selected="selected">'.$this->main_category->name .'</option>
                        '.$optionsMainCategories.'
                    </select>
                    <label for="editSub_category_id">Főategória</label>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="editSub_category_id" id="editSub_category_id" required>
                        <option disabled>Kérem válasszon alkategóriát</option>
                        <option value="'.$this->sub_category_id.'" selected="selected">'.$this->sub_category->name .'</option>
                        '.$optionsSubCategories.'
                    </select>
                    <label for="editSub_category_id">Alkategória</label>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="brand_id" id="editBrand_id" required>
                        <option selected disabled>Kérem válasszon márkát</option>
                        <option value="'.$this->brand_id.'" selected="selected">'.$this->brand->name.'</option>
                        '.$optionsBrands.'
                    </select>
                    <label for="editBrand_id">Márka</label>
                </div>
                <div class="form-floating mb-2">
                    <select class="form-control select2" name="amount_unit_id" id="editAmount_unit_id" required>
                        <option selected disabled>Kérem válasszon mennyiségi egységet</option>
                        <option value="'.$this->amount_unit_id.'" selected="selected">'.$this->amount_unit->name.'</option>
                        '.$optionsUnits.'
                    </select>
                    <label for="editAmount_unit_id">Mennyiségi egység</label>
                </div>
                <div class="form-floating mb-2">
                    <textarea class="form-control" name="description" id="editDescription"
                        placeholder="Leírás ..." style="height: 180px">'.$this->description.'</textarea>
                    <label for="editDescription">Leírás...</label>
                </div>';        
    }
}
