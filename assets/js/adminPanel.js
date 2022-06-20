let idWisataHapus = 0;
$("div[data-aksi='hapus']").click((e) => {
    let id = e.currentTarget.dataset['idWisata'];
    idWisataHapus = id;
});

$("#btn-hapus").click((e) => {
    $.ajax({
        url: `adminPanel.php?page=kelolaObjek&hapus=${idWisataHapus}`,
        type: 'GET',
        success: (data) => {
            idWisataHapus = 0;
            location.reload();
        }
    })
})


// $("#uploadThumbnail").click();


$("div[data-aksi='edit']").click((e) => {
    let id = e.currentTarget.dataset['idWisata'];
    $.ajax({
        url: "adminPanel.php?page=kelolaObjek&edit=" + id,
        type: 'GET',
        success: (data) => {
            $('#navbar-side').nextAll("div").remove();
            $('#navbar-side').after(data)

            // alert(1)
        }
    })
});

function tambah() {

    $.ajax({
        url: "adminPanel.php?page=kelolaObjek&tambah",
        type: 'GET',
        success: (data) => {
            $('#navbar-side').nextAll("div").remove();
            $('#navbar-side').after(data)
        }
    })
}

$('body').click(function (e) {
    let target = e.target;   
    // thumbnail click 
    if(target.dataset['aksi'] == 'upload'){
        $('#input-thumbnail').click()        
        
        $(document).on("change", "#input-thumbnail", function () {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
            
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function () { // set image data as background of div
                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                    // uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                    $('#content-thumbnail').css("background-image", "url(" + this.result + ")");
                }
            }
    
        });

    }    
    // galeri click
    if(target.dataset['aksi'] == 'upload-galeri'){
        $(`#input-galeri-${target.dataset['galeriTarget']}`).click();
        let id = "#input-galeri-" + target.dataset['galeriTarget'];
        $(document).on("change", id , function () {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function () { // set image data as background of div
                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                    // uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                    $(`#content-galeri-${target.dataset['galeriTarget']}`).css("background-image", "url(" + this.result + ")");                    
                }
            }
    
        });
    }
    // add galeri
    if(target.dataset['aksi'] == 'upload-new-galeri'){
        $(`#input-new-galeri-${target.dataset['newGaleriTarget']}`).click();
        let id = "#input-new-galeri-" + target.dataset['newGaleriTarget'];                
        $(document).on("change", id , function () {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
            let idIcon = "#content-new-galeri-" + target.dataset['newGaleriTarget'] + " div svg";
            let contentInfo = "#content-new-galeri-" + target.dataset['newGaleriTarget'] + " div";
            
            let length = 0;
            for(let i = 0; i < files.length; i++){                
                if (/^image/.test(files[i].type)) {
                    length++;
                }else{
                    alert("File yang diupload harus berupa gambar");
                    return;
                }
            }
            $(idIcon).remove();        // remove icon
            $(contentInfo).text(length + " Gambar terpilih") //  change text
    
        });
    }

    // sending data
    if(target.id == "send-form-edit" ){        
        let formData = new FormData();
        
        let id = $('#IdWisata').val();
        let nama = $('#NamaWisata').val();
        let hargaWisata = $('#HargaWisata').val();
        let deskripsi = $('#DeskripsiWisata').val();
        
        formData.append('thumbnail', $('.uploadFileImg')[0].files[0]);

        for(let i=1; i<$('.uploadFileImg').length; i++){      
            for(let j=0; j<$('.uploadFileImg')[i].files.length; j++){
                formData.append("galeri" + (i +j),$('.uploadFileImg')[i].files[j]);            
            }                
        }        
        
        formData.append('id', id);        
        formData.append('nama', nama);         
        formData.append('harga', hargaWisata);
        formData.append('deskripsi', deskripsi);
        formData.append('edit', 'true');

        $.ajax({
            url: "adminPanel.php?page=kelolaObjek",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data);
                // location.reload();
            }
        })


    }    
})

$(document).ready(function () {
    // search input 
    $('#search').on("input",function () {
        let search = $('#search').val();
        let dataTable = $("#container-wisata .nama-wisata");
        let cardWisata = $("#container-wisata .card-wisata");
        let indexWisata =$("#container-wisata .index-wisata"); 
        // search jquery 
        let index = 0;
        dataTable.map(i => {
            if(dataTable[i].innerText.toLowerCase().includes(search.toLowerCase())){
                index ++;
                indexWisata[i].textContent = index;
                cardWisata[i].classList.remove("d-none");
            }else{
                cardWisata[i].classList.add("d-none");
            }
        })            

    });
})