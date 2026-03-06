const login_btn=document.querySelector('#login');

const subnav=document.querySelector('.subnav');

login_btn.addEventListener("click",(e)=>{
    e.preventDefault();
        if( subnav.classList.contains('hide')){
        subnav.classList.replace("hide","show");
        }else{
             subnav.classList.replace("show","hide");
        }
        
    
})



fetch(`/checkshop`,{ 
    method: 'POST',
    headers: {'Content-Type': 'application/json',},
    body: JSON.stringify({cust_id: cust_id.value })
}).then(response=>response.json())
.then(data=>{
    
        const home=document.getElementById("home");
        home.addEventListener("click", (e)=>{
            e.preventDefault();
            if(data.hasshop["cust_hasshop"]=="yes"){
                window.location.href="/home_usershop";
            }else{
                window.location.href="/user_home";
            }
        })
    
})
.catch(error => alert("Error: " + error))