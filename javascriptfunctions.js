<script>

  function removeOptions(selectbox)//used to remove select option so is used for subProblem()
             {
                   var i;
                   for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
                       {
                          selectbox.remove(i);
                       }
             }
//using the function:

       
             
         function subProblem()
                {
           
           removeOptions(document.getElementById("subproblem"));
           
           var content = {printer : ["Select","Printing","Printer Software","Printer Que Cancellation"],operatingSystem:["Select","Drivers","Blue Screen"],hardware:["Select","Screen","Hard Drive"],software:["No Sub Problem"],select:["No Sub Problem"]}
       
             var e = document.getElementById("problem");
           var select = document.getElementById("subproblem"); 
             var strUser = e.options[e.selectedIndex].text;
      if (strUser=="Printer"){     
         for(var i = 0; i < content.printer.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.printer[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.printer[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
      if (strUser=="Operating System"){    
         for(var i = 0; i < content.operatingSystem.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.operatingSystem[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.operatingSystem[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
        else if (strUser=="Hardware"){     
         for(var i = 0; i < content.hardware.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.operatingSystem[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.operatingSystem[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
            else if (strUser=="Software"){     
         for(var i = 0; i < content.software.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.software[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.software[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
            else if (strUser=="Select"){     
         for(var i = 0; i < content.select.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.select[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.select[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }

         }
	

</script>