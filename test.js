
function readtitle() {
    title = document.title;
    sessionStorage.setItem("key", title);
    
    
};

function get() {

    
    document.getElementById('mission_name').value = sessionStorage.getItem("key");
   

};


function special() {

    title = "*" + document.title;
    sessionStorage.setItem("key", title);
    

};



