

$(document).ready(function() {

        // Setup - add a text input to each footer cell
        $('.datatable tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control" />' );
        } );

        // DataTable
        $('.datatable').DataTable({
            // responsive: true,
            // orderCellsTop: true,
            fixedHeader: true,
            "scrollX": true,
            // pageLength: 100,
            dom: 'lBfrtip',
            buttons: [
                {extend: "pdf", exportOptions: {columns:':visible'}, className: "btn btn-sm btn-primary",},
                {extend: "excel", exportOptions: {columns:':visible'}, className: "btn btn-sm btn-primary",},
                {extend: "colvis", className: "btn btn-sm btn-primary",},
            ],

            initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }
        });

        // -----------backend/user_account/dashboard-------------
        $('#datatableTodaytask tfoot th').each(function() {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control" />' );
        });

        $('#datatableTodaytask').DataTable({

            initComplete:function() {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }
        })



//------------------------ image upload
// $(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.for-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });


// });

// var upload = new FileUploadWithPreview("myUniqueUploadId", {
//     showDeleteButtonOnImages: true,
//     text: {
//         chooseFile: "Upload image...",
//         browse: "Upload",
//         // selectedCount: "Custom Files Selected Copy",
//     },
//     images: {
//         baseImage: "https://via.placeholder.com/468x250?text=680+x+250",
//     },
//     presetFiles: [
//         // "../public/logo-promosis.png",
//         // "https://images.unsplash.com/photo-1557090495-fc9312e77b28?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80",
//     ],
// });

//-------------------- title with slug
$("#title").keyup(function(){
    var str = $(this).val();
    var trims = $.trim(str)
    var slug = trims.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
    $("#slug").val(slug.toLowerCase());
});

//--------------------------- Alert message
$(document).ready(function() {
    $("#alert").fadeTo(2000, 500).fadeOut(2000, function(){
        $("#alert").alert('close');
    });
});

// --------------Ck editor
ClassicEditor
.create( document.querySelector( '#editor' ) )
.catch( error => {
    console.error( error );
} );


//-------------------------Diff in days
$("#to-date, #from-date").change(function(){

    var edate = new Date($('#to-date').val());
    var sdate = new Date($('#from-date').val());

    days = (edate- sdate) / (1000 * 60 * 60 * 24);
    days = days+1;
    // alert (days);
    if(days > 0){
        $("#days").val(days);
    }
    else{
        $("#days").val(0);
    }
 });

//  --------------------------------Select2 Option
$('.select2').select2({
    placeholder: '-- Select --'
  });



});