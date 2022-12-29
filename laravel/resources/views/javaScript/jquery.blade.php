<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!--Inclue jquery-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <p id="text" value="1">meowhecker</p>
    <button onclick="selectByTag()">send</button>

    <!--Using the selector to get the element-->
    <!-- jquery("<id>") -> we could use $("") to instead with -->
    

        <form id="form1" action="">
            First name: <input type="text" name="fname" value="meow"><br>
            Last name: <input type="text" name="lname" value="hecker"><br><br>
            <input type="submit" value="test">
        </form>
        
        <p id="show"></p>

    <script>


        //select the form

        const formObject = document.forms["form1"];
        let text =" ";

        for(let i=0; i<formObject.length ; i++){
            //get form element value 
            text += formObject.elements[i].value;
        }

        document.getElementById('show').innerHTML= text;

        function selectByTag(){
            const textNode = $("text");
            const getElementValue = 
            console.log(textNode);
        }

    </script>
    
    
</body>
</html>