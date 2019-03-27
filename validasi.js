// Check All Checbox pake class checkbox1
$(document).ready(function() {
    $('#cek').click(function(event) {  //on click 
        if(this.checked) { // check select status
          $('.checkbox1').each(function() { 
              this.checked = true;                            
          });
        }else{
          $('.checkbox1').each(function() { 
              this.checked = false;                 
          });         
        }
    });  
});

$(document).ready(function(){

  $('#inserts').bootstrapValidator({
    feedbackIcons: {
      //valid: 'glyphicon glyphicon-ok',
      //invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      nama: {
        validators: {
          stringLength: {
            min: 3,
            max: 50,            
            message: 'Nama min: 3 karakter!'
          },
          notEmpty: {
            message: 'harus di isi!'
          }
        }
      },
      harga: {
        validators:{
          integer: {
           message: 'Harga harus angka!'
          },
          stringLength: {
            min: 4,
            max: 16,
            message: 'min: 4, max: 16 digit!'
          },
          notEmpty: {
            message: 'harus di isi!'
          }
        }
      },
      stok: {
        validators:{
          integer: {
           message: 'harus angka!'
          },
          stringLength: {
            max: 4,
            min: 1,
            message: 'max: 4, min: 1 digit !'
          },
          notEmpty: {
            message: 'harus di isi!'
          }
        }
      },
      desk: {
        validators:{
          notEmpty: {
            message: 'Deskripsi harus di isi!'
          },
          stringLength: {
            min: 20,
            max: 1000,
            message: 'min: 20, max:1000 karakter!'
          }
        }
      },
      email: {
                validators: {
                 notEmpty: {
                   message: 'Email harus di isi!'
                    },
                    emailAddress: {
                        message: 'Masukan Email yang benar!'
                    },
                }
            },
      fullName: {
                validators: {
                  notEmpty: {
                   message: 'Nama harus di isi!'
                    },
                  stringLength: {
                    min: 3,
                    max: 32,
                    message: 'min: 3, max: 32 karakter!'
                  },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'Input nama yang benar!'
                    }
                }
            },
      pass2: {
                validators: {
                    notEmpty: {
                     message: 'Password harus di isi!'
                    },
                    identical: {
                        field: 'pass1',
                        message: 'Password tidak sama !'
                    }
                }
            },
      pass1: {
                validators: {
                    notEmpty: {
                     message: 'Password harus di isi!'
                    },
                    stringLength: {
                      min: 5,
                      max: 32,
                      message: 'min: 5, max: 32 karakter!'
                    }
                }
            },
      pass4: {
                validators: {
                    identical: {
                        field: 'pass3',
                        message: 'Password tidak sama !'
                    }
                }
            },
      pass3: {
                validators: {
                    stringLength: {
                      min: 5,
                      max: 32,
                      message: 'min: 5, max: 32 karakter!'
                    }
                }
            },
      alamat: {
                validators: {
                    notEmpty: {
                     message: 'Alamat harus di isi!'
                    },
                    stringLength: {
                      min: 10,
                      max: 255,
                      message: 'min: 10, max: 255 karakter!'
                    }
                }
            },
      komentar: {
                validators: {
                    notEmpty: {
                     message: 'Komentar harus di isi!'
                    },
                    stringLength: {
                      min: 10,
                      max: 255,
                      message: 'min: 10, max: 255 karakter!'
                    }
                }
            },
      code: {
                validators: {
                    notEmpty: {
                     message: 'Captcha harus di isi!'
                    },                    
                }
            },
      tlp: {
                validators: {
                    notEmpty: {
                     message: 'No telephone harus di isi!'
                    },
                    stringLength: {
                      min: 5,
                      max: 20,
                      message: 'min: 5, max: 20 karakter!'
                    }
                }
            },
      username: {
                validators: {
                    notEmpty: {
                     message: 'Username harus di isi!'
                    },                    
                    stringLength: {
                      min: 5,
                      max: 20,
                      message: 'min: 5, max: 20 karakter!'
                    }
                }
            }
    }
  });
});

$(document).ready(function(){
  $('#inserts2').bootstrapValidator({
    feedbackIcons: {
      //valid: 'glyphicon glyphicon-ok',
      //invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      nama: {
        validators: {
          stringLength: {
            min: 3,
            max: 50,            
            message: 'Nama min: 3 karakter!'
          },
          notEmpty: {
            message: 'harus di isi!'
          }
        }
      }
    } 
  });
});


/*$(document).ready(function(){
  $("#provinsi").click(function(event){
    var provinsi_id=$("#provinsi").val();
            $.ajax({
                type:"GET",
                url:"get_kokab.php",
                data:"provinsi_id="+provinsi_id,
                success:function(html)
                {
                   $("#kabupaten").html(html);  
                }
            });
  });
});
*/
$(document).ready(function(){
    $("#provinsi").click(function(event){
            var provinsi_id=$("#provinsi").val();
            $.ajax({
                type:"GET",
                url:"get_kokab.php",
                data:"provinsi_id="+provinsi_id,
                success:function(html)
                {
                   $("#kabupaten").html(html);  
                }
            });
    });
});

/*$(document).ready(function(){
  $('.date').datepicker({
      weekStart: 2,
      startDate: "01/10/2013",
      endDate: "01/12/2013"
  });
});*/

$(document).ready(function(){
  $('#sandbox-container .input-daterange').datepicker({
    format    : 'dd MM, yyyy'
  });
});
