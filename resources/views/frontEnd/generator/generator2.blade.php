@extends('frontEnd.layouts.app')

@section('contents')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400..800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
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
        font-size: 16px;
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

    .h30V2{
        background-color: white;
        height: 400px;
        border-radius: 10px;
        overflow-y: scroll;
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

    .borderViolet{
        border: 1px solid #5B3AFF;
        border-radius: 15px;
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
</style>


<div class="container">
    <section style="padding: 0">
        <div class="breadcrumb_design">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb_item"><a href="/">Home</a></li>
                    <li class="breadcrumb_item active" aria-current="page"><a href="/blog/category">Generators</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section style="padding: 0">
        <div class="container">
            <div class="mt-2">
                <h3 class="d-flex justify-content-center">Enter word search with images content</h3>
                <h6 class="d-flex justify-content-center colorGrey">30 by 30 is about as big as makes sense help</h6>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-start">
                    <div class="borderRadius borderGrey">
                        <button id="generator" class="btn m-2 borderRadius bgActive" onclick="onChangeView('generator')">Generator</button>
                        <button id="theme" class="btn m-2 borderRadius bgInActive"onclick="onChangeView('theme')">Theme</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <p class="font-weight-bold">How to make</p>&nbsp; <span><i class="fa fa-play" style="color: #F01E76;" aria-hidden="true"></i></span>
                </div>
            </div>
            <!-- START:  Default -->
            <div id="default" style="display: block;" class="mt-4">
                <div class="row">
                    <div class="col-md-7">
                        <div class="bgOffset pr-5" style="border-radius: 10px;">
                            <!-- START : Worksheet View -->
                            <div id="worksheetView" style="display: block;">
                                <div class="p-3">
                                    <p class="font16w500">Title Default</p>
                                    <div class="borderRadius bg-white">
                                        <p class="pt-2 pb-2 pl-2">word search with images</p>
                                    </div>
                                </div>
                                <div class="row mt-3 pl-3">
                                    <div class="col-md-7">
                                        <div class="row ml-2">
                                            <div class="col-md-6">
                                                <p class="font16w500">Select Word</p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-end">
                                                    <select name="type" id="type" class="borderRadius borderGrey font-weight-bold clrPink p-2" onchange="onChangeType()">
                                                        <option class="font12w400" value="Fruit">Fruit</option>
                                                        <option class="font12w400" value="Animal">Animal</option>
                                                        <option class="font12w400" value="Flowers">Flowers</option>
                                                        <option class="font12w400" value="Country">Country</option>
                                                    </select>
                                                    <!-- <div class="dropdown">
                                                        <button class="btn bg-white dropdown-toggle borderRadius borderGrey font-weight-bold clrPink" type="button" id="select" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                    Select
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="select">
                                                            <a class="dropdown-item Disabled" href="#">Select one</a>
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Disabled action</a>
                                                            <a class="dropdown-item" href="#">AA</a>
                                                            <a class="dropdown-item" href="#">BB</a>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 h30">
                                            <div id="typeList" class="ml-3 font14w400">
                                                <input id="word1" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word1', 'Apple')"> &nbsp; <span class="font14w400">Apple</span> <br>
                                                <input id="word2" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word2', 'Banana')"> &nbsp; <span class="font14w400">Banana</span> <br>
                                                <input id="word3" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word3', 'Cranberry')"> &nbsp; <span class="font14w400">Cranberry</span> <br>
                                                <input id="word4" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word4', 'Blackcurrant')"> &nbsp; <span class="font14w400">Blackcurrant</span> <br>
                                                <input id="word5" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word5', 'Blueberry')"> &nbsp; <span class="font14w400">Blueberry</span> <br>
                                                <input id="word6" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word6', 'Avocados')"> &nbsp; <span class="font14w400">Avocados</span> <br>
                                                <input id="word7" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word7', 'Atemoya')"> &nbsp; <span class="font14w400">Atemoya</span> <br>
                                                <input id="word8" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word8', 'Rose apple/Water apple')"> &nbsp; <span class="font14w400">Rose apple/Water apple</span> <br>
                                                <input id="word9" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word9', 'Coconut')"> &nbsp; <span class="font14w400">Coconut</span> <br>
                                                <input id="word10" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word10', 'Finger lime')"> &nbsp; <span class="font14w400">Finger lime</span> <br>
                                                <input id="word11" type="checkbox" class="checkBox mt-3" onchange="onSelectWord('word11', 'Cherimoya')"> &nbsp; <span class="font14w400">Cherimoya</span> <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="font16w500">Written or Selected Words </p>
                                        <div class="mt-4 h30">
                                            <div id="selectedWords" class="ml-1 mt-2 font12w400">
                                                <ul>
                                                    <li>Use a comma or press enter between words.</li>
                                                    <li>Minimum word length: 3 letters</li>
                                                    <li>word length: Maximum20 letters</li>
                                                    <li>Recommended number of words: 40</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-3">
                                    <div class="col-md">
                                        <p class="font16w500">Number of letters Down</p>
                                        <div class="borderRadius borderOffPink bg-white d-flex justify-content-around h45">
                                            <i class="fa fa-minus mt-2" style="color: #F01E76; cursor: pointer;" aria-hidden="true" onclick="onLetterDown('MINUS')"></i>
                                            <p id="letterDown" class="mt-2">10</p>
                                            <i class="fa fa-plus mt-2" style="color: #F01E76; cursor: pointer;" aria-hidden="true" onclick="onLetterDown('PLUS')"></i>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <p class="font16w500">Number of letters Across</p>
                                        <div class="borderRadius borderOffPink bg-white d-flex justify-content-around h45">
                                            <i class="fa fa-minus mt-2" style="color: #F01E76;" aria-hidden="true" onclick="onLetterAcross('MINUS')"></i>
                                            <p id="letterAcross" class="mt-2">10</p>
                                            <i class="fa fa-plus mt-2" style="color: #F01E76;" aria-hidden="true" onclick="onLetterAcross('PLUS')"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="font16w500">Letter Case</p>
                                        <select name="letterCase" id="letterCase" class="borderRadius borderGrey font-weight-bold clrPink p-2">
                                            <option class="font12w400" value="Uppercase">Uppercase</option>
                                            <option class="font12w400" value="Lowercase">Lowercase</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row pl-2 mt-4 mb-5">
                                    <div class="col-md-6">
                                        <button class="btn m-2 borderRadius bg-white borderOffPink w-100 cursorPointer" onclick="reset()">Reset</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn m-2 borderRadius borderOffPink w-100 cursorPointer bgActive" onclick="onGenerateWorksheet()">Generate Worksheet</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END : Worksheet View -->
                            <!-- START : Theme View -->
                            <div id="themeView" style="display: none;">
                                <div class="p-2 row">
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme1')">
                                        <img id="theme1" class="themeImg" src="assets/img/border-image1.jpg">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme2')">
                                        <img id="theme2" class="themeImg" src="assets/img/border-image2.png">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme3')">
                                        <img id="theme3" class="themeImg" src="assets/img/border-image3.jpg">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme4')">
                                        <img id="theme4" class="themeImg" src="assets/img/border-image4.png">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme5')">
                                        <img id="theme5" class="themeImg" src="assets/img/border-image5.png">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme6')">
                                        <img id="theme6" class="themeImg" src="assets/img/border-image6.png">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme7')">
                                        <img id="theme7" class="themeImg" src="assets/img/border-image7.png">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme8')">
                                        <img id="theme8" class="themeImg" src="assets/img/border-image8.jpg">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme9')">
                                        <img id="theme9" class="themeImg" src="assets/img/border-image9.png">
                                    </div>
                                </div>
                            </div>
                            <!-- END : Theme View -->
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="bgOffset" style="border-radius: 10px;">
                            <div class="p-3">
                                <p class="font16w500">Worksheet Preview</p>
                            </div>
                            <div class="pl-3 pr-3">
                                <div class="mt-3 borderRadius bg-white d-flex justify-content-center">
                                    <button id="worksheet" class="btn m-2 borderRadius bgActive pl-5 pr-5" onclick="onWorksheetPreviewChange('worksheet')">Worksheet</button>
                                    <button id="answerkey" class="btn m-2 borderRadius bgInActive pl-5 pr-5" onclick="onWorksheetPreviewChange('answerkey')">Answer Key</button>
                                </div>
                            </div>
                            <div class="pl-3 pr-3">
                                <div class="mt-4 h30V2">
                                    <div id="worksheetPreview" class="p-2 ml-1 mt-2 font12w400">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pr-3 pl-2">
                                <button class="btn m-2 borderRadius bgPink borderOffPink text-white w-100">
                                    <img src="./assets/img/download-04.png" alt="">&nbsp;
                                    Download Worksheet
                                </button>
                                <button class="btn m-2 borderRadius bg-white borderOffPink w-100">
                                    <img src="./assets/img/download-04.png" alt="">&nbsp;
                                    Download Answer Key
                                </button>
                                <button class="btn m-2 borderRadius bg-white borderOffPink w-100 cursorPointer" onclick="preview('previewModal')">Full Preview</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- START: Modal -->
            <div class="modal" id="previewModal" style="display: none; backdrop-filter: blur(2px);">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div>
                            <button type="button" class="closeModal" onclick="hideModal('previewModal')">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id="modalContent" class="p-1">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal -->
            <!-- END:  Default -->

            <!-- START:  Tab -->
            <div id="tab" style="display: none;" class="mt-4">
                <div class="row">
                    <div class="col-md">
                        <div class="bgOffset pr-3" style="border-radius: 10px;">
                            <div class="p-2">
                                <p class="font14w500Tab">Title</p>
                                <div class="borderRadius bg-white">
                                    <p class="pt-2 pb-2 pl-2">word search with images</p>
                                </div>
                            </div>
                            <div class="row mt-3 pl-2">
                                <div class="col-sm-7">
                                    <div class="row ml-2">
                                        <div class="col-sm-6">
                                            <p class="font14w500Tab">Select Word</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex justify-content-end">
                                                <select name="type" id="type" class="borderRadius borderGrey font-weight-bold clrPink p-2">
                                                    <option class="font12w400" value="Animal">Animal</option>
                                                    <option class="font12w400" value="Fruit">Fruit</option>
                                                    <option class="font12w400" value="Flowers">Flowers</option>
                                                    <option class="font12w400" value="Country">Country</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 h30">
                                        <div class="ml-2 font12w400Tab">
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Apple</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Banana</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Cranberry</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Blackcurrant</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Blueberry</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Avocados</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Atemoya</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Rose apple/Water apple</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Coconut</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Finger lime</span> <br>
                                            <input type="checkbox" class="checkBox mt-3"> &nbsp; <span class="font14w400">Cherimoya</span> <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="font14w500Tab">Written or Selected Words</p>
                                        </div>
                                    </div>

                                    <div class="h30Tab">
                                        <div class="mt-2 font10w400Tab">
                                            <ul>
                                                <li>Use a comma or press enter between words.</li>
                                                <li>Minimum word length: 3 letters</li>
                                                <li>word length: Maximum20 letters</li>
                                                <li>Recommended number of words: 40</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pl-2">
                                <div class="col-sm">
                                    <p class="font14w500Tab">Number of letters Down</p>
                                    <div class="borderRadius borderOffPink bg-white d-flex justify-content-around h45">
                                        <i class="fa fa-minus mt-2" style="color: #F01E76;" aria-hidden="true"></i>
                                        <p class="mt-2">10</p>
                                        <i class="fa fa-plus mt-2" style="color: #F01E76;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <p class="font14w500Tab">Number of letters Across</p>
                                    <div class="borderRadius borderOffPink bg-white d-flex justify-content-around h45">
                                        <i class="fa fa-minus mt-2" style="color: #F01E76;" aria-hidden="true"></i>
                                        <p class="mt-2">10</p>
                                        <i class="fa fa-plus mt-2" style="color: #F01E76;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <p class="font14w500Tab">Letter Case</p>
                                    <select name="letterCase" id="letterCase" class="borderRadius borderOffPink font-weight-bold clrPink pt-2 pb-2">
                                        <option class="font10w400Tab" value="Uppercase">Uppercase</option>
                                        <option class="font10w400Tab" value="Lowercase">Lowercase</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pl-2 mt-4 mb-5">
                                <div class="col-sm-6">
                                    <button class="btn m-2 borderRadius bg-white borderOffPink w-100">Reset</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn m-2 borderRadius bg-white borderOffPink w-100">Generate Worksheet</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm">
                        <div class="bgOffset" style="border-radius: 10px;">
                            <div class="p-3">
                                <p class="font14w500Tab">Worksheet Preview</p>
                            </div>
                            <div class="pl-3 pr-3">
                                <div class="mt-3 borderRadius bg-white d-flex justify-content-center">
                                    <button class="btn m-2 borderRadius bgActive pl-5 pr-5">Worksheet</button>
                                    <button class="btn m-2 borderRadius bgInActive pl-5 pr-5">Answer Key</button>
                                </div>
                            </div>
                            <div class="pl-3 pr-3">
                                <div class="mt-4 h30V2">
                                    <div class="ml-1 mt-2 font10w400Tab">
                                        <p class="ml-2 pt-2"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pr-3 pl-2">
                                <button class="btn m-2 borderRadius bgPink borderOffPink text-white w-100">
                                    <img src="./assets/img/download-04.png" alt="">&nbsp;
                                    Download Worksheet
                                </button>
                                <button class="btn m-2 borderRadius bg-white borderOffPink w-100">
                                    <img src="./assets/img/download-04.png" alt="">&nbsp;
                                    Download Answer Key
                                </button>
                                <button class="btn m-2 borderRadius bg-white borderOffPink w-100">Full Preview</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END:  Tab -->
        </div>
    </section>
</div>


<script>

    var selectedWordList = [];

    var animals = ["Cow", "Horse", "Cat", "Elephant", "Tiger", "Dog", "Lion", "Fox", "Goat"];
    var fruit = ["Apple", "Banana", "Cranberry", "Blackcurrant", "Blueberry", "Avocados", "Atemoya", "Rose apple/Water apple", "Coconut", "Finger lime", "Cherimoya"];

    var words = this.fruit;

    var letterDownValue = 10;
    var letterAcrossValue = 10;

    // Selected First theme
    var selectedTheme = document.getElementById('theme1').getAttribute('src');
    document.getElementById('theme1').classList.add('borderViolet');

    function viewChange(){
        var width = window.innerWidth;

        if(width > 650){
            document.getElementById('default').style.display = 'block';
            document.getElementById('tab').style.display = 'none';
        }else{
            document.getElementById('default').style.display = 'none';
            document.getElementById('tab').style.display = 'block';
        }
    }

    //viewChange();


    function onChangeView(id){

        if(id == 'generator'){
            document.getElementById('generator').classList.replace('bgInActive', 'bgActive');
            document.getElementById('theme').classList.replace('bgActive', 'bgInActive');
            document.getElementById('worksheetView').style.display = 'block';
            document.getElementById('themeView').style.display = 'none';
        }else{
            document.getElementById('theme').classList.replace('bgInActive', 'bgActive');
            document.getElementById('generator').classList.replace('bgActive', 'bgInActive');
            document.getElementById('worksheetView').style.display = 'none';
            document.getElementById('themeView').style.display = 'block';
        }
    }

    function onChangeType(){
        var type = document.getElementById('type').value;
        var html = '';

        if(type == 'Fruit'){
            this.words = this.fruit;

        }else if(type == 'Animal'){
            this.words = this.animals

        }

        this.words.forEach(e => {
            html += '<input id="word' + (this.words.indexOf(e)+1) + '" type="checkbox" class="checkBox mt-3" onchange="onSelectWord(\'word'+(this.words.indexOf(e)+1)+'\', \''+e+'\')"> &nbsp; <span class="font14w400">'+ e +'</span> <br>';
        });

        document.getElementById('typeList').innerHTML = html;
    }


    function onSelectWord(id, word){
        var html = '';

        if(document.getElementById(id).checked){
            this.selectedWordList.push(word)
        }else{
            this.selectedWordList = this.selectedWordList.filter(e => e != word);
        }

        this.selectedWordList.forEach(e => {
            html += '<p class = "borderRadius borderGrey pl-2 pb-1 pt-1 w-50">'+e+'&nbsp; &nbsp;<i class = "fa fa-x cursorPointer" onclick="onUnSelectWord(\''+e+'\')"></i></p>';
        });

        document.getElementById('selectedWords').innerHTML = html;
    }

    function onUnSelectWord(word){
        var html = '';

        this.selectedWordList = this.selectedWordList.filter(e => e != word);

        this.selectedWordList.forEach(e => {
            html += '<p class = "borderRadius borderGrey pl-2 pb-1 pt-1 w-50">'+e+'&nbsp; &nbsp;<i class = "fa fa-x cursorPointer" onclick="onUnSelectWord(\''+e+'\')"></i></p>';
        });

        document.getElementById('selectedWords').innerHTML = html;
        document.getElementById('word'+(this.words.indexOf(word)+1)).checked = false;
    }

    function onSelectTheme(id){

        this.selectedTheme = document.getElementById(id).getAttribute('src');

        if(document.getElementById('worksheetContent') != undefined && document.getElementById('worksheetContent') != null){
            document.getElementById('worksheetContent').style.borderImage = 'url('+this.selectedTheme+') 30% stretch';

        }

        var elementsList = document.getElementsByClassName('themeImg');

        for (let index = 0; index < elementsList.length; index++) {

            document.getElementById(elementsList[index].id).classList.remove('borderViolet')
        }

        document.getElementById(id).classList.add('borderViolet');
    }

    function onWorksheetPreviewChange(id){
        var worksheetTRs = document.getElementsByTagName('tr');

        if(id == 'worksheet'){
            document.getElementById('worksheet').classList.replace('bgInActive', 'bgActive');
            document.getElementById('answerkey').classList.replace('bgActive', 'bgInActive');

            for (let i = 0; i < worksheetTRs.length; i++) {
                for (let j = 0; j < worksheetTRs[i].childNodes.length; j++) {
                    worksheetTRs[i].childNodes[j].style.backgroundColor = '';
                    worksheetTRs[i].childNodes[j].style.color = '';
                }
            }

        }else{
            document.getElementById('answerkey').classList.replace('bgInActive', 'bgActive');
            document.getElementById('worksheet').classList.replace('bgActive', 'bgInActive');

            for (let i = 0; i < worksheetTRs.length; i++) {

                if(i > 5){
                    break;
                }

                for (let j = 0; j < worksheetTRs[i].childNodes.length; j++) {
                    if(j == i){
                        worksheetTRs[i].childNodes[j].style.backgroundColor = 'yellow';
                    }

                    if(j+2 == i - 1){
                        worksheetTRs[i].childNodes[j].style.backgroundColor = 'green';
                    }

                    if(j == 8){
                        worksheetTRs[i].childNodes[j].style.backgroundColor = 'red';
                        worksheetTRs[i].childNodes[j].style.color = 'white';
                    }

                }
            }
        }

    }

    function onLetterDown(action){

        if(action == 'PLUS'){
            this.letterDownValue += 1;
            document.getElementById('letterDown').innerText = this.letterDownValue;
        }else{
            this.letterDownValue -= 1;
            document.getElementById('letterDown').innerText = this.letterDownValue;

        }

    }

    function onLetterAcross(action){
        if(action == 'PLUS'){
            this.letterAcrossValue += 1;
            document.getElementById('letterAcross').innerText = this.letterAcrossValue;
        }else{
            this.letterAcrossValue -= 1;
            document.getElementById('letterAcross').innerText = this.letterAcrossValue;

        }
    }

    function reset(){
        window.location.reload();
    }

    function onGenerateWorksheet(){

        generateHtmlForWorksheet('worksheetPreview');

    }

    function generateHtmlForWorksheet(id){

        const alphabet = 'abcdefghijklmnopqrstuvwxyz';

        var numberDown = document.getElementById('letterDown').innerText;
        var numberAcross = document.getElementById('letterAcross').innerText
        var letterCase = document.getElementById('letterCase').value;
        var html = '';

        html += '<div id="worksheetContent" class="p-1" style = "border: 30px solid transparent; border-image: url('+this.selectedTheme+') 25% stretch;">'
        html += '<p class="borderRadius bg-white d-flex justify-content-center font-weight-bold borderGolden p-1">Word Search with images</p>'
        html += '<div class="d-flex justify-content-center">'
        html += '<table class="table-bordered">'
        html += '<tbody>';
        for (let i = 0; i < parseInt(numberDown); i++) {
            html += '<tr>';
            for (let j = 0; j < parseInt(numberAcross); j++) {
                // Generate a random index
                const randomIndex = Math.floor(Math.random() * alphabet.length);
                // Select the character at the random index
                const randomChar = alphabet[randomIndex];
                html += '<td>';
                if(letterCase == "Uppercase"){
                    html += randomChar.toUpperCase() + '</td>';
                }else{
                    html += randomChar.toLowerCase() + '</td>';
                }
            }
            html += '</tr>';

        }
        html += '</tbody>'
        html += '</table>'
        html += '</div>'
        html += '</div>';

        document.getElementById(id).innerHTML = html;

    }

    function preview(id){
        document.getElementById(id).style.display = 'block';

        var html = document.getElementById('worksheetContent');

        document.getElementById('modalContent').innerHTML = html.outerHTML;
        //generateHtmlForWorksheet('modalContent');
    }

    function hideModal(id){
        document.getElementById(id).style.display = 'none';
    }
</script>

@endsection