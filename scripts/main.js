document.getElementById('button').addEventListener('click', 
function(){
document.querySelector('.bg-modal').style.display = 'flex';
});

document.querySelector('.close').addEventListener('click',
function(){
    document.querySelector('.bg-modal').style.display = 'none';
});

function validateForm(){
    let fn = document.forms["myForm"]["fname"].value;
    let ln = document.forms["myForm"]["lname"].value;
    let em = document.forms["myForm"]["email"].value;
    let sub = document.forms["myForm"]["subject"].value;
    var mes = document.getElementById("message").value;
        if (fn==""||ln==""||em==""||sub==""||mes=="") {
            alert("All fields are required!");
            return false;   
}
    
}
