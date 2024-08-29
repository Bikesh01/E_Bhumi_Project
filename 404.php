<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 error Not found</title>
    <link  rel="shortcut icon" type="image/png" href="images/logo/white.png">
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            letter-spacing: 1.5px;
            font-family: sans-serif;
        }

        /* Global styles */
        html,
        body {
            text-transform: capitalize;
        }

        a {
            text-decoration: none;
        }

        :root {
            --theme-primary-color: #17c788;
            --theme-primary-hover-color: #34d19a;
            --theme-dark-color: #091b4b;
        }

        .page-404 {
            height: 100vh;
            width: 100%;
            background-image: linear-gradient(to top, white 0%, #dfe9f3 100%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-404 {
            height: 70vh;
            width: 70vw;
            background-color: white;
            border-radius: 10px;
            /* box-shadow: rgba(255, 255, 255, 0.1) 0px 1px 1px 0px inset, rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; */
            box-shadow: rgba(9, 32, 63, 0.1) 0px 1px 1px 0px inset,
                rgba(83, 120, 149, 0.4) 0px 50px 100px -20px,
                rgba(0, 0, 0, 0.5) 0px 30px 60px -30px;
        }

        .column-two {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            height: 100%;
            padding: 20px;

        }

        .right-col,
        .left-col {
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;

        }


        .left-col {
            background-color: lightseagreen;
           

        }

        .content-right-col {
        margin-left: 30px;
        }
        .head{
            display: flex;
            align-items: center;
            gap: 20px;
        }
        span{
            font-size: 20px;
            color: red;
            font-weight: 700;
        }
        h1 {

            color: red;
            font-size: 100px;
        }

        h3 {
            margin-top: 30px;
            margin-bottom: 30px;
            color: var(--theme-primary-color);
            font-size: 30px;
        }

        p {
            font-size: 13px;
            margin-top: 40px;
            margin-bottom: 50px;
            line-height: 30px;
        }

       
        button a {
            font-size: 16px;
            color: #dfe9f3;
            font-weight: 600;
        }

        button {
            border: none;

            background-color: var(--theme-primary-hover-color);
            padding: 16px 24px;

            border-radius: 10px;
            transition: all 0.3s linear;

        }

        button:hover {
            background-color: var(--theme-primary-color);
        }

        button a {
            transition: all 0.3s linear;
        }

        /* button a:hover {

            color: var(--theme-dark-color);
        } */

        .main-404 img{
            padding: 20px;
          width: 100%;
          height: 100%;
        }
    </style>
</head>

<body>
    <!--------- Start Not Fount Section --------->
    <div class="page-404">
        <div class="main-404">
            <div class="column-two">
                <div class="right-col">
                    <div class="content-right-col">
                        <div class="head"><h1>404</h1> <span>Error</span></div>
                        <h3>Page Not Found</h3>
                        <p>"Uh-oh! You've stumbled upon an empty lot. Our apologies! Explore our listings or contact us for help finding your dream home."
                        </p>
                        <button><a href="index.php">Back To Home</a></button>
                    </div>
                </div>
                <div class="left-col">
                    <img src="images/404.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!--------- End Not Fount Section --------->
</body>

</html>