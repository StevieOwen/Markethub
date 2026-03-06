const shopname = document.getElementById('shopname');
const shopdescription = document.getElementById('shopdescription');
const shoplogo = document.getElementById('shoplogo');
const form=document.querySelector('#shopForm');
const shopcontact=form.querySelector("#shopcontact");

const pName = document.getElementById('p-name');
const pDesc = document.getElementById('p-desc');
const pInitial = document.getElementById('p-initial');
const pImg = document.getElementById('p-img');
const pContact=document.getElementById("p-contact");


const launchbutton=document.querySelector("#launchshop") ;
// Name Sync
shopname.oninput = () => {
    pName.innerText = shopname.value || "Your Shop Name";
    pInitial.innerText = shopname.value ? shopname.value.charAt(0).toUpperCase() : "M";
};

//contact sync
shopcontact.oninput = () => {
    pContact.innerText = shopcontact.value || "Your Shop Name";
};

// Description Sync
shopdescription.oninput = () => {
    pDesc.innerText = shopdescription.value || "Your shop description will appear here as you type...";
};

// Logo Sync
shoplogo.onchange = function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            pImg.src = e.target.result;
            pImg.classList.remove('d-none');
            pInitial.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
};

form.addEventListener("submit", (e) => {
    e.preventDefault();

    // Reset error messages first
    document.querySelectorAll('.error-text').forEach(el => el.innerText = "");

    const shopname = form.querySelector("#shopname");
    const shopdescription = form.querySelector("#shopdescription");
    const shopcontact=form.querySelector("#shopcontact");
    const cust_id=document.querySelector("#cust_id");
    const shoplogo = form.querySelector("#shoplogo");
    
    let isValid = true; // Flag to track validation

    // Basic Validation
    if (shopname.value === "") {
        document.querySelector("#emptyname").innerText = "The shop name is required";
        isValid = false;
    }

    if (shopdescription.value === "") {
        document.querySelector("#emptydesc").innerText = "A description is required";
        isValid = false;
    }

    if (shopcontact.value === "") {
        document.querySelector("#emptycontact").innerText = "A contact is required";
        isValid = false;
    }


    // Only proceed if validation passed
    if (isValid) {
        //to send the image and texts we use formData instead of json
        const formData = new FormData();

        formData.append("name", shopname.value);
        formData.append("description", shopdescription.value);
        formData.append("contact", shopcontact.value);
        formData.append("seller", cust_id.value);

       if (shoplogo.files[0]) {
            formData.append("logo", shoplogo.files[0]);
        }

        fetch(`/registerShop`, {
            method: 'POST',
           body: formData
        })
        .then(response => response.json())
        .then(data => {
            // console.log("State:", data);
            if( data.status=="Successfully created"){
                const modal = document.querySelector("#successModal");
                if (modal) {
                    modal.setAttribute("style", "display: flex !important;");
                    
                } else {
                    
                }

                setTimeout(() => {
                    window.location.href = "/dashboard";
                }, 2500);
            }
             
        })
        .catch(error => alert("Error: " + error));
    }
});



