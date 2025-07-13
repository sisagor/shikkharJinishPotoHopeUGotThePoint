<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    * {
        box-sizing: border-box;
    }
    .colorGrey{
        color: grey;
    }

    .borderRadius{
        border-radius: 25px;
    }

    .borderOffPink{
        border: 1px solid #FAB9D5;
    }

    .borderGrey{
        border: 1px solid grey;
    }

    .bgPink{
        background-color: #F01E76;
    }

    .bgOffset{
        background-color: #F7F5FF;
        height: fit-content;
    }

    .bgActive{
        background-color: #F01E76;
        color: white;
    }

    .bgInActive{
        background-color: #FEF6F9;
        color: black;
    }
    .clrPink{
        color: #F01E76;
    }

    .font16w500{
        font-size: 14px;
        font-weight: 500;
    }

    .font14w400{
        color: #262528;
        font-size: 14px;
        font-weight: 400;
    }

    .font12w400{
        color: #262528;
        font-size: 12px;
        font-weight: 400;
    }

    .h30{
        background-color: white;
        height: 85%;
        width: 100%;
        border-radius: 10px;
        overflow-y: scroll;
    }

    .h30V2 {
        background-color: white;
        height: 400px;
        border-radius: 10px;
        overflow-y: scroll;
        margin-bottom: 20px;
    }

    .h45{
        height: 40px;
    }

    .checkBox{
        border: 1px solid #E9E9EA;
        height: 16px;
        width: 16px;
    }

    .themeImg{
        width: 150px;
        height: 150px;
        cursor: pointer;
    }

    .cursorPointer{
        cursor: pointer;
    }

    .closeModal{
        background-color: white;
        border: none;
        border-radius: 50%;
        margin-right: -25px;
        margin-top: -25px;
        float: right;
    }

    .borderGolden{
        border: 1px solid goldenrod;
    }

    td{
        padding: 5px;
    }
    /* TAB CSS */
    .font14w500Tab{
        font-size: 14px;
        font-weight: 500;
    }

    .font12w400Tab{
        color: #262528;
        font-size: 12px;
        font-weight: 400;
    }

    .font10w400Tab{
        color: #262528;
        font-size: 10px;
        font-weight: 400;
    }

    .h30Tab{
        background-color: white;
        height: 85%;
        width: 100%;
        border-radius: 10px;
        overflow-x: scroll;
    }

    .toggle-container {
        display: inline-flex;
        background-color: white;
        border-radius: 50px;
        padding: 4px;
        position: relative;
        overflow: hidden;
        gap: 8px;
        border: 1px solid #ddd;
    }

    .toggle-option {
        padding: 10px 20px;
        border-radius: 46px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
        border: none;
        background: transparent;
        color: #666;
        width: 110px;
        text-align: center;
    }

    .toggle-option.bgActive {
        background-color: #F01E76;
        color: white;
        box-shadow: 0 2px 8px rgba(240, 30, 118, 0.3);
    }

    .toggle-option.bgInActive {
        background-color: transparent;
        color: #666;
    }

    .toggle-option.bgInActive:hover {
        color: #333;
        background-color: rgba(233, 30, 99, 0.1);
    }

    .toggle-option:focus {
        outline: none;
    }
    /*==========word select css*/
    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-right: 15px;
    }
    /* Style the select to match the button */
    .fruits-select {
        background: #e91e63;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 500;
        appearance: none; /* remove default arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20fill%3D'white'%20height%3D'16'%20viewBox%3D'0%200%2024%2024'%20width%3D'16'%20xmlns%3D'http://www.w3.org/2000/svg'%3E%3Cpath%20d%3D'M7%2010l5%205%205-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 16px;
        cursor: pointer;
    }

    /* On focus */
    .fruits-select:focus {
        outline: none;
        box-shadow: none;
        background: #c2185b;
    }

    .word-label {
        display: flex;
        align-items: center;
        margin-top: 1rem; /* replaces mt-3 */
        font-size: 14px;
        font-weight: 400;
        cursor: pointer;
    }

    .checkBox {
        margin-right: 8px;
        width: 16px;
        height: 16px;
    }
    .tag-btn {
        display: inline-flex;
        align-items: center;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 14px;
        cursor: default;
        color: #333;
        transition: background-color 0.3s;
    }

    .tag-btn i {
        margin-left: 8px;
        cursor: pointer;
        color: #888;
    }

    .tag-btn:hover {
        background-color: #e0e0e0;
    }

    .tag-btn i:hover {
        color: #dc3545; /* red close icon on hover */
    }
    .btn_custom{
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .wordListTextarea{
        width: 100%;
        height: 442px;
        padding: 15px;
        font-size: 14px;
        font-family: inherit;
        border: none;
        border-radius: 10px;
        background-color: #f9f9f9;
        resize: vertical;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.08);
    }
    .wordListTextarea:focus {
        outline: none;
        background-color: #fff;
        box-shadow: 0 0 0 2px #cdd5fd;
    }
</style>
