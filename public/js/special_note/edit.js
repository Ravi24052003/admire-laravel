$(document).ready(function() {
    $('#special_note').summernote({
    placeholder: '',
    tabsize: 2,
    height: 400
    });

  });



document.addEventListener('DOMContentLoaded', function(){

    let dBDestination = document.getElementById("_destination")?.dataset?.destination;

    const optionsArray = [
        { value: "Kerala", label: "Kerala" },
        { value: "Goa", label: "Goa" },
        { value: "Delhi", label: "Delhi" },
        { value: "Rajasthan", label: "Rajasthan" },
        { value: "Ladakh", label: "Ladakh" },
        { value: "Andaman", label: "Andaman" },
        { value: "Andhra-Pradesh", label: "Andhra Pradesh" },
        { value: "Arunachal-Pradesh", label: "Arunachal Pradesh" },
        { value: "Assam", label: "Assam" },
        { value: "Bihar", label: "Bihar" },
        { value: "Chhattisgarh", label: "Chhattisgarh" },
        { value: "Gujarat", label: "Gujarat" },
        { value: "Haryana", label: "Haryana" },
        { value: "Himachal-Pradesh", label: "Himachal Pradesh" },
        { value: "Jharkhand", label: "Jharkhand" },
        { value: "Karnataka", label: "Karnataka" },
        { value: "Kashmir", label: "Kashmir" },
        { value: "Madhya-Pradesh", label: "Madhya Pradesh" },
        { value: "Maharashtra", label: "Maharashtra" },
        { value: "Manipur", label: "Manipur" },
        { value: "Meghalaya", label: "Meghalaya" },
        { value: "Mizoram", label: "Mizoram" },
        { value: "Nagaland", label: "Nagaland" },
        { value: "Odisha", label: "Odisha" },
        { value: "Punjab", label: "Punjab" },
        { value: "Sikkim", label: "Sikkim" },
        { value: "Tamil-Nadu", label: "Tamil Nadu" },
        { value: "Telangana", label: "Telangana" },
        { value: "Tripura", label: "Tripura" },
        { value: "Uttar-Pradesh", label: "Uttar Pradesh" },
        { value: "Uttarakhand", label: "Uttarakhand" },
        { value: "West-Bengal", label: "West Bengal" },
        { value: "Chandigarh", label: "Chandigarh" },
        { value: "Lakshadweep", label: "Lakshadweep" },
        { value: "Puducherry", label: "Puducherry" },
        { value: "Thailand", label: "Thailand" },
        { value: "UAE", label: "UAE" },
        { value: "Indonesia", label: "Indonesia" },
        { value: "Maldives", label: "Maldives" },
        { value: "Saudi-Arabia", label: "Saudi Arabia" },
        { value: "Malaysia", label: "Malaysia" },
        { value: "USA", label: "USA" },
        { value: "Spain", label: "Spain" },
        { value: "Israel", label: "Israel" },
        { value: "France", label: "France" },
        { value: "China", label: "China" },
        { value: "Vietnam", label: "Vietnam" },
        { value: "UK", label: "United Kingdom" },
        { value: "Tunisia", label: "Tunisia" },
        { value: "Sri-Lanka", label: "Sri Lanka" },
        { value: "Russia", label: "Russia" },
        { value: "Japan", label: "Japan" },
        { value: "Great-Britain", label: "Britain" },
        { value: "Italy", label: "Italy" },
        { value: "Estonia", label: "Estonia" },
        { value: "Australia", label: "Australia" },
        { value: "Turkey", label: "Turkey" }
    ];
    
    // Get the select element
    const selectedDestination = document.getElementById("destination");

    if(dBDestination){
        optionsArray.forEach(option => {
            const optionElement = document.createElement("option");
            optionElement.value = option.value;
            if(dBDestination==option.value){
                optionElement.selected = true;
            }
            optionElement.innerText = option.label;
            selectedDestination.appendChild(optionElement);
        });
    }
    else{
        optionsArray.forEach(option => {
            const optionElement = document.createElement("option");
            optionElement.value = option.value;
            optionElement.innerText = option.label;
            selectedDestination.appendChild(optionElement);
        });
    }
    
})