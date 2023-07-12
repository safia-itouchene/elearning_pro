
const themeBtn = document.querySelector(".theme-btn");
themeBtn.addEventListener('click',()=>{
     document.body.classList.toggle('dark-theme-var');
     themeBtn.querySelector('span:nth-child(1)').classList.toggle('active');
     themeBtn.querySelector('span:nth-child(2)').classList.toggle('active');
});



const currentLocation = location.href;
const menuItem = document.querySelectorAll('a');
const menuLen = menuItem.length;
for(let i =0;i<menuLen; i++){
if(menuItem[i].href===currentLocation){
 menuItem[i].className="active"
}
}


function openTab(evt, Name) {
   
  var i, tabcontent, tablinks;

  
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  
  document.getElementById(Name).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();



function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}

function showPreview2(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-2-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}



function validateblogFormabout()                                 
         { 
             var blogTitle = document.forms["blogFormabout"]["url1"];         
             if (blogTitle.value == ""){ 
                 document.getElementById('errorurl1').innerHTML="Champ obligatoire";  
                 blogTitle.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorurl1').innerHTML="";  
             }

             var subTitle = document.forms["blogFormabout"]["url2"];         
             if (subTitle.value == ""){ 
                 document.getElementById('errorurl2').innerHTML="Champ obligatoire";  
                 subTitle.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorurl2').innerHTML="";  
             }

             var blogCont = document.forms["blogFormabout"]["url3"];         
             if (blogCont.value == ""){ 
                 document.getElementById('errorurl3').innerHTML="Champ obligatoire";  
                 blogCont.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorurl3').innerHTML="";  
             }


             var blogCont = document.forms["blogFormabout"]["url4"];         
             if (blogCont.value == ""){ 
                 document.getElementById('errorurl4').innerHTML="Champ obligatoire";  
                 blogCont.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorurl4').innerHTML="";  
             }

             var blogCont = document.forms["blogFormabout"]["url5"];         
             if (blogCont.value == ""){ 
                 document.getElementById('errorurl5').innerHTML="Champ obligatoire";  
                 blogCont.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorurl5').innerHTML="";  
             }
         }

         function showPreview(event){
          if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";
          }
        }
        
        function showPreview3(event){
          if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-3-preview");
            preview.src = src;
            preview.style.display = "block";
          }
        }
        function validateblogForm()                                 
                 { 
                     var blogTitle = document.forms["blogForm"]["blog_title"];         
                     if (blogTitle.value == ""){ 
                         document.getElementById('errorblog_title').innerHTML="Champ obligatoire";  
                         blogTitle.focus(); 
                         return false; 
                     }else{
                         document.getElementById('errorblog_title').innerHTML="";  
                     }
        
                     var subTitle = document.forms["blogForm"]["blog_sub_title"];         
                     if (subTitle.value == ""){ 
                         document.getElementById('errorsub_title').innerHTML="Champ obligatoire";  
                         subTitle.focus(); 
                         return false; 
                     }else{
                         document.getElementById('errorsub_title').innerHTML="";  
                     }
        
                     var cover = document.forms["blogForm"]["cover"];         
                     if (cover.value == ""){ 
                         document.getElementById('errorsub_cover').innerHTML="Champ obligatoire";  
                         cover.focus(); 
                         return false; 
                     }else{
                         document.getElementById('errorsub_cover').innerHTML="";  
                     }
        
                     var blogCont = document.forms["blogForm"]["blog_cont"];         
                     if (blogCont.value == ""){ 
                         document.getElementById('errorsub_txt').innerHTML="Champ obligatoire";  
                         blogCont.focus(); 
                         return false; 
                     }else{
                         document.getElementById('errorsub_txt').innerHTML="";  
                     }
                 }


                 function validateblogFormedit()                                 
         { 
             var blogTitle = document.forms["blogForm"]["blog_title"];         
             if (blogTitle.value == ""){ 
                 document.getElementById('errorblog_title').innerHTML="Champ obligatoire";  
                 blogTitle.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorblog_title').innerHTML="";  
             }

             var subTitle = document.forms["blogForm"]["blog_sub_title"];         
             if (subTitle.value == ""){ 
                 document.getElementById('errorsub_title').innerHTML="Champ obligatoire";  
                 subTitle.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorsub_title').innerHTML="";  
             }

             var blogCont = document.forms["blogForm"]["blog_cont"];         
             if (blogCont.value == ""){ 
                 document.getElementById('errorsub_txt').innerHTML="Champ obligatoire";  
                 blogCont.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorsub_txt').innerHTML="";  
             }
         }


         function showPreview(event){
          if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";
          }
        }
        
        
        
        function validateForm3()                                 
                 { 
                     var catName = document.forms["myForm3"]["cat_name"];         
                     if (catName.value == ""){ 
                         document.getElementById('errorprecategory_name').innerHTML="Champ obligatoire";  
                         catName.focus(); 
                         return false; 
                     }else{
                         document.getElementById('errorprecategory_name').innerHTML="";  
                     }
        
                     var cover = document.forms["myForm3"]["cover"];         
                     if (cover.value == ""){ 
                         document.getElementById('errorpreuploadimage').innerHTML="Champ obligatoire";  
                         cover.focus(); 
                         return false; 
                     }else{
                         document.getElementById('errorpreuploadimage').innerHTML="";  
                     }
                 }
                 function validateForm4()                                 
                 { 
                     var catName = document.forms["myForm4"]["cat_name"];         
                     if (catName.value == ""){ 
                         document.getElementById('errorprecategory').innerHTML="Champ obligatoire";  
                         catName.focus(); 
                         return false; 
                     }else{
                         document.getElementById('errorprecategory').innerHTML="";  
                     }
                 }




                 function validateForm5()                                 
         { 
             var subCat = document.forms["myForm5"]["sub_cat_name"];         
             if (subCat.value == ""){ 
                 document.getElementById('errorpresub_cat').innerHTML="Champ obligatoire";  
                 subCat.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorpresub_cat').innerHTML="";  
             }
         }


         function validateForm6()                                 
         { 
             var subCat = document.forms["myForm6"]["sub_cat_name"];         
             if (subCat.value == ""){ 
                 document.getElementById('errorpresub_cat').innerHTML="Champ obligatoire";  
                 subCat.focus(); 
                 return false; 
             }else{
                 document.getElementById('errorpresub_cat').innerHTML="";  
             }
         }
