function bruttoCalc() {
    const netto = $('#netto').val() *1;
    const vat = $('#vat_id').val() *1;

    const vat_sum = netto * vat / 100;
    const brutto = vat_sum + netto;
    
    if (brutto != null) {
        document.getElementById("vat_sum").value = vat_sum;
        document.getElementById("brutto").value = brutto;
    }
}

function nettoCalc() {
    const brutto = $('#brutto').val() *1;
    const vat = $('#vat_id').val() *1;

    const netto = brutto / ((100 + vat) / 100);
    const vat_sum = brutto - netto;
    
    if (netto != null) {
        document.getElementById("vat_sum").value = vat_sum;
        document.getElementById("netto").value = netto;
    }
}

function editBruttoCalc() {
    const netto = $('#editNetto').val() *1;
    const vat = $('#editVat_id').val() *1;

    const vat_sum = netto * vat / 100;
    const brutto = vat_sum + netto;
    
    if (brutto != null) {
        document.getElementById("editVat_sum").value = vat_sum;
        document.getElementById("editBrutto").value = brutto;
    }
}

function editNettoCalc() {
    const brutto = $('#editBrutto').val() *1;
    const vat = $('#editVat_id').val() *1;

    const netto = brutto / ((100 + vat) / 100);
    const vat_sum = brutto - netto;
    
    if (netto != null) {
        document.getElementById("editVat_sum").value = vat_sum;
        document.getElementById("editNetto").value = netto;
    }
}