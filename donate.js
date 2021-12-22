


function donate(){

$.ajax({
    url:'donate.php',
    type:'POST',
    data:{},
    success:function(result){
        if(result.data=='0'){
            var typeModal = new bootstrap.Modal(document.getElementById("donationresult"+result), {
            keyboard: false
        });
        }
        else{
            var typeModal = new bootstrap.Modal(document.getElementById("donationresult"+result), {
            keyboard: false
        });
        }
        typeModal.show();
    }
});

}


