<style type="text/css" media="screen">
    *, ::after, ::before {
        box-sizing: border-box;
    }
    body{
        font-family: sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
    }
    .body{
        background: #f8fbfd;
        width: 100%;
    }
    .im {
        /*color: #000000 !important;*/
    }
    a{
        text-decoration: none !important;
    }
    hr {
        margin: 1rem 0;
        color: inherit;
        background-color: currentColor;
        border: 0;
        opacity: .25;
        border-bottom: 1px solid #cccc;
    }
    .h1, h1 {
        font-size: calc(1.375rem + 1.5vw);
    }
    .h2, h2 {
        font-size: calc(1.325rem + .9vw);
    }
    .h3, h3 {
        font-size: calc(1.3rem + .6vw);
    }
    .h4, h4 {
        font-size: calc(1.275rem + .3vw);
    }
    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .text-nowrap{
        white-space: nowrap !important;
    }
    .text-start{
        text-align: left !important;
    }
    .tabla{
            margin: 0 auto;
            text-align: left;
            border: 2px solid #23b4b7;
            border-radius: 6px;
            padding: 10px;
            word-break: break-word;
    }
    .tabla td{
        vertical-align: middle;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 5px;
        line-height: 1.42857143;
        vertical-align: top;
        border: 1px solid #ddd;
    }
    .table-striped>tbody>tr:nth-of-type(odd) {
        background: #f2f2f2;
    }
    .fs-3 {
        font-size: 1.75rem!important;
    }
    .fs-4 {
        font-size: 1.5rem!important;
    }
    .fs-5 {
        font-size: 1.25rem!important;
    }
    .fs-6 {
        font-size: 1rem!important;
    }
    .fs-7 {
        font-size: 0.9rem!important;
    }
    .fs-8 {
        font-size: 0.7rem!important;
    }
    .bg-dark {
        background-color: #212529!important;
    }
    .bg-white{
        background-color: white !important;
    }
    .bg-info{
        background-color: #e5f5ff !important;
    }
    .bg-informacion{
        border: 2px solid #23b4b7;
        display: inline-block;
        border-radius: 8px;
        display: flex;
        width: 30%;
        margin: 0 auto;
        overflow-wrap: break-word;
    }
    .bg-informacion figure{
        width: 20%;
        margin: 5% 0;
        padding: 4px;
    }
    .bg-informacion figure img{
        height: 24px;
    }
    .bg-informacion span{
        width: 80%;
        padding: 6px;
    }
    .bg-informacion span i{
        display: block;
         margin-bottom: 4px;
    }
    .bg-informacion span b{
        font-size: 18px;
        line-height: 1.2;
        word-break: break-word;
    }
    .text-verde{
        color: #23b4b7 !important;
    }
    .btn {
        display: inline-block;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 15px;
        border-radius: 0.25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .btn-outline-dark {
        color: #212529 !important;
        border-color: #212529;
    }
    .btn-outline-dark:hover {
        color: #fff !important;
        background-color: #212529;
        border-color: #212529;
    }
    .btn-dark {
        color: #fff !important;
        background-color: #212529;
        border-color: #212529;
    }
    .card-compra {
        /*background: #f8fbfd;*/
        background-color: white;
        text-align: center;
        height: 100%;
    }
    .card-compra i {
        font-size: 45px;
    }
    .container {
        width: 80%;
        margin: 0 auto;
    }
    .container-fluid {
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .container:before, .container:after, .container-fluid:before, .container-fluid:after, .row:before, .row:after{
        display: table;
        content: " ";
        clear: both;
    }
    .row {
        /*--bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;*/
        margin-right: -15px;
        margin-left: -15px;
        overflow: hidden;
    }
    .row>* {
        /*flex-shrink: 0;
        width: 100%;
        max-width: 100%;*/
        padding-right: 15px;
        padding-left: 15px;
        position: relative;
        float: left;
    }
    .justify-content-center {
        justify-content: center!important;
    }
    div {
        display: block;
    }
    .col-lg-12 {
        flex: 0 0 auto;
        width: 100%;
    }
    .col-12 {
        flex: 0 0 auto;
        width: 100%;
    }
    .col-2 {
        flex: 0 0 auto;
        width: 16.66666667%;
    }
    .col-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }
    .col-6 {
        flex: 0 0 auto;
        width: 50%;
    }
    .text-start {
        text-align: left!important;
    }
    .text-center {
        text-align: center!important;
    }
    .text-end {
        text-align: right!important;
    }
    .text-secondary {
        color: #6c757d!important;
    }
    .text-white {
        color: #fff!important;
    }
    .fw-bold {
        font-weight: 700!important;
    }
    .rounded-2 {
        border-radius: 0.25rem!important;
    }
    .border {
        border: 1px solid #dee2e6!important;
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    img, svg {
        vertical-align: middle;
    }
    .pt-1 {
        padding-top: 0.25rem!important;
    }
    .p-2 {
        padding: 0.5rem!important;
    }
    .p-3 {
        padding: 1rem!important;
    }
    .p-4 {
        padding: 1.5rem!important;
    }
    .pb-1 {
        padding-bottom: 0.25rem!important;
    }
    .pt-1 {
        padding-top: 0.25rem!important;
    }
    .pb-3 {
        padding-bottom: 1rem!important;
    }
    .pt-3 {
        padding-top: 1rem!important;
    }
    .pb-4 {
        padding-bottom: 1.5rem!important;
    }
    .pt-4 {
        padding-top: 1.5rem!important;
    }
    .pb-5 {
        padding-bottom: 3rem!important;
    }
    .pt-5 {
        padding-top: 3rem!important;
    }
    .ps-0 {
        padding-left: 0!important;
    }
    .pe-0 {
        padding-right: 0!important;
    }
    .ps-3 {
        padding-left: 1rem!important;
    }
    .pe-3 {
        padding-right: 1rem!important;
    }
    .px-0 {
        padding-right: 0!important;
        padding-left: 0!important;
    }
    .py-0 {
        padding-top: 0!important;
        padding-bottom: 0!important;
    }
    .px-3 {
        padding-right: 1rem!important;
        padding-left: 1rem!important;
    }
    .px-4 {
        padding-right: 1.5rem!important;
        padding-left: 1.5rem!important;
    }
    .m-0 {
        margin: 0!important;
    }
    .mt-0 {
        margin-top: 0!important;
    }
    .mb-0 {
        margin-bottom: 0!important;
    }
    .mt-1 {
        margin-top: 0.25rem!important;
    }
    .mb-1 {
        margin-bottom: 0.25rem!important;
    }
    .mb-2 {
        margin-bottom: 0.5rem!important;
    }
    .mt-2 {
        margin-top: 0.5rem!important;
    }
    .mb-3 {
        margin-bottom: 1rem!important;
    }
    .mt-3 {
        margin-top: 1rem!important;
    }
    .mb-4 {
        margin-bottom: 1.5rem!important;
    }
    .mt-4 {
        margin-top: 1.5rem!important;
    }
    .mb-5 {
        margin-bottom: 3rem!important;
    }
    .mt-5 {
        margin-top: 3rem!important;
    }
    .centrado{
        margin: 0 auto;
        float: none !important;
    }

    .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-weight: 600;
        line-height: 1.2;
    }
    .h5, h5 {
        font-size: 1.25rem;
    }
    .h6, h6 {
        font-size: 1rem;
    }

    .loguito{
        height: 85px;
        background: white;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: -43px;
    }


    /*media querys*/
    @media(max-width: 992px){
        .bg-informacion{
            width: 70%;
        }
    }
    @media(max-width: 768px){
        .container{
            width: 100%;
        }
        .bg-informacion span{
            padding: 10px 12px;
        }
    }

    @media (min-width: 768px){
        .col-md-10 {
            flex: 0 0 auto;
            width: 83.33333333%;
        }
        .col-md-8 {
            flex: 0 0 auto;
            width: 66.66666667%;
        }
        .col-md-5 {
            flex: 0 0 auto;
            width: 41.66666667%;
        }
        .col-md-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
        }
        .p-md-5 {
            padding: 3rem!important;
        }
        .pb-md-2 {
            padding-bottom: 0.5rem!important;
        }
        .pt-md-2 {
            padding-top: 0.5rem!important;
        }
        .mt-md-4 {
            margin-top: 1.5rem!important;
        }
        .ps-md-4 {
            padding-left: 1.5rem!important;
        }
        .pe-md-4 {
            padding-right: 1.5rem!important;
        }
    }
    @media (min-width: 992px){
        .col-lg-10 {
            flex: 0 0 auto;
            width: 83.33333333%;
        }
        .col-lg-8 {
            flex: 0 0 auto;
            width: 66.66666667%;
        }
        .col-lg-6 {
            flex: 0 0 auto;
            width: 50%;
        }
        .col-lg-5 {
            flex: 0 0 auto;
            width: 41.66666667%;
        }
        .col-lg-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
        }

        .pb-lg-2 {
            padding-bottom: 0.5rem!important;
        }
        .pt-lg-2 {
            padding-top: 0.5rem!important;
        }
        .mt-lg-0 {
            margin-top: 0!important;
        }
        .mb-lg-0 {
            margin-bottom: 0!important;
        }
        /**/
        .body{
            background: #f8fbfd;
            width: 85%;
            margin: 0 auto;
            padding: 20px;
        }
    }
    @media (min-width: 1200px){
        .h1, h1 {
            font-size: 2.5rem;
        }
        .h2, h2 {
            font-size: 2rem;
        }
        .h3, h3 {
            font-size: 1.75rem;
        }
        .h4, h4 {
            font-size: 1.5rem;
        }

    }


</style>
