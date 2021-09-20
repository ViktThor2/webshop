<table class="table">
            <tr>
                <td></td>
                <td>
                    <div class="row">
                        <div class="col-3" id="product_image">
                            <img src="img/product/@{{ image1 }}" id="product_img"/>
                            <button class="btn btn-link btn-sm" id="deleteImage"
                                    data-id="@{{ id }}"  data-image="@{{ image }}">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>'
                        </div>
                        <div class="col-3" id="product_image">
                            <img src="img/product/@{{ image2 }}" id="product_img"/>
                            <button class="btn btn-link btn-sm" id="deleteImage"
                                    data-id="@{{ id }}"  data-image="@{{ image }}">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>'
                        </div>
                        <div class="col-3" id="product_image">
                            <img src="img/product/@{{ image3 }}" id="product_img"/>
                            <button class="btn btn-link btn-sm" id="deleteImage"
                                    data-id="@{{ id }}"  data-image="@{{ image }}">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>'
                        </div>
                        <div class="col-3" id="product_image">
                            <img src="img/product/@{{ image4 }}" id="product_img"/>
                            <button class="btn btn-link btn-sm" id="deleteImage"
                                    data-id="@{{ id }}"  data-image="@{{ image }}">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>'
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="25%">Név:</td>
                <td>@{{ name }}</td>
            </tr>
            <tr>
                <td>Nettó:</td>
                <td>@{{ netto }}</td>
            </tr>
            <tr>
                <td>Áfa:</td>
                <td>@{{ vat_sum }}</td>
            </tr>
            <tr>
                <td>Bruttó:</td>
                <td>@{{ brutto }}</td>
            </tr>
            <tr>
                <td>Márka:</td>
                <td>@{{ brand_id }}</td>
            </tr>
            <tr>
                <td>Kategória:</td>
                <td>@{{ main_category_id }} / @{{ sub_category_id }}</td>
            </tr>
            <tr>
                <td>Mennyiség:</td>
                <td>@{{ qty }}</td>
            </tr>
            <tr>
                <td>Leírás:</td>
                <td>@{{ description }}</td>
            </tr>
        </table>