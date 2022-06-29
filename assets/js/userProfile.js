$("#upload-profile").click(() => {
    $('#input-user-profile').click();
    $(document).on("change", "#input-user-profile", function () {        
        let files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            let reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div                
                $('#upload-profile').css("background-image", "url(" + this.result + ")");
                $('#upload-profile').addClass("border-warning border-4")
            }
        }

    });
    
})

function sendProfileChange(idUser){
    let profileForm = new FormData();
    let username = $("#username").val();
    let password = $("#password").val();
    let nama = $("#nama").val();
    let noTelp = $("#noTelp").val();
    let alamat = $("#alamat").val();
    let profile = $("#input-user-profile").prop("files")[0]

    // console.log(profile)
    
        // console.log(profile);    
    profileForm.append("username",username)
    profileForm.append("password",password)
    profileForm.append("nama",nama)
    profileForm.append("noTelp",noTelp)
    profileForm.append("alamat",alamat)
    profileForm.append("profile",profile)
    profileForm.append("changeProfile",idUser)
    
    $.ajax({
        url: "?page=profile",
        type: 'POST',
        data: profileForm,
        contentType: false,
        processData: false,
        success: (data) => {                            
            alert(data);
            location.href = "index.php?page=profile";
        }
    })    
}