document.getElementById('id').focus();


// WebWorker ///////////////////////////////
//
// if(typeof(Worker) !== "undefined") {
//     if(typeof(w) == "undefined") {
//         w = new Worker("demo_workers.js");
//     }
//     w.onmessage = function(event) {
//         document.getElementById("result").innerHTML = event.data;
//     };
// } else {
//     document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Workers...";
// }
//
//
// function stopWorker() { 
//     w.terminate();
//     w = undefined;
// }
//
///////////////////////////////////





// buttonAdd = document.getElementById("add");


// buttonAdd.addEventListener("click", add);
// document.getElementById("del").addEventListener("click", del);

// document.getElementById("back").addEventListener("click", window.history.back());

var inputCode = document.getElementById("id");
var products = [];
var total = 0;
var error = false;
var input_id = document.getElementById('id');
var bottomTicket = document.getElementById('bottomTicket')

var scroll = document.getElementById('detalleTicket');
$body = $("body");


function add() {
    if (document.getElementById('id').value == '') {
        document.getElementById('id').value = '';
        document.getElementById('id').focus();
        return;
    }
    input_id.disabled = true;
    // buttonAdd.disabled=true;
    id = document.getElementById('id').value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://clientsl.local/cart/add/product/" + id, true);
   
    xhr.send();
     
    xhr.onreadystatechange = function () {
      if(xhr.status == 0) {
           input_id.disabled = false;
            alert('someting was worng: Server Fail');
            return;
        } 
        if (xhr.readyState == 4 && xhr.status == 200) {
            // document.getElementById("parrafo").innerHTML = xhr.responseText;
            var res = JSON.parse(xhr.responseText)
            if (res.typeCode!='F'){
                var table = document.getElementById("mytable").getElementsByTagName('tbody')[0]
                var row = table.insertRow(table.rows.length);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                cell1.innerHTML = res.product.name;
                cell1.className = "celda";
                // .toLowerCase().replace(/\b[a-z]/g, function (letra) {
                    // return letra.toUpperCase();
                // });;
                cell2.innerHTML = res.product.color;
                cell2.className = "hidden-480 celda";
                price = parseInt(res.product.price); 
                cell3.innerHTML = price.toFixed(2);
                cell3.className = "celda";
                total = price * 1;
                cell4.innerHTML = total.toFixed(2);
                cell4.className = "celda";

                // <button class="btn btn-danger">
                //     <i class="fa fa-trash-o"></i>
                // </button>
                cell5.innerHTML = '<td><button class="btn btn-danger" onclick="deleteRow(this)"> <i class="fa fa-trash-o">x</i></button ></td>';
                // <input type="button" value="Delete" onclick="deleteRow(this)"></td>';
                products.push(res.product);
                if (res.typecode == '404') {   
                error=true;
                } else { error=false}
            }else{
                alert("intem no encontrado");
                // $.gritter.add({
                //     title: (typeof title !== 'undefined') ? title : 'POS SYSTEM - Item no encontrado',
                //     text: (typeof message !== 'undefined') ? message : 'No se pudo cargar el item, revise el codigo',
                //     image: (typeof image !== 'undefined') ? image : null,
                //     sticky: (typeof sticky !== 'undefined') ? sticky : true,
                //     time: (typeof time !== 'undefined') ? time : 3000
                // });

            } 

            sum(); 
            input_id.disabled = false   ;

            // buttonAdd.disabled = false;   
        }    
        document.getElementById('id').value = '';
        document.getElementById('id').focus();
        
    } 
   
}    

function sum(input) {
    console.log(products);
    if (toString.call(products) !== "[object Array]")
        return false;
    var total = 0;
    for (var i = 0; i < products.length; i++) {
        if (isNaN(products[i]['price'])) {
            continue;
        }
        console.log(products[i]['price']);
        total += Number(products[i]['price']);
    }
    document.getElementById("total").innerHTML = total;
    document.getElementById("gtotal").innerHTML = total ;
    console.log(total);
}

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("mytable").deleteRow(i);
    products.splice(i, 1);
    sum(); 
}    
function del() {
    
    clear();
    document.getElementById('id').focus();
    sum(); 
}    



// Execute a function when the user releases a key on the keyboard
inputCode.addEventListener("keyup", function (event) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
        add(); 
        bottomTicket.scrollIntoView(false);
    }   
});    


function clear(){
    var tableHeaderRowCount = 1;
    var table = document.getElementById('mytable');
    var rowCount = table.rows.length;
    for (var i = tableHeaderRowCount; i < rowCount; i++) {
        table.deleteRow(tableHeaderRowCount);
    }    
    products= [];
}    