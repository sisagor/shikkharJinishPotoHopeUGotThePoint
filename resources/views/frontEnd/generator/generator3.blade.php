@extends('frontEnd.layouts.app')
@section('contents')
    @include('frontEnd.generator.generatorStyle')
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
                <h3 class="d-flex justify-content-center">Matching Lists With Images Generator</h3>
                <h6 class="d-flex justify-content-center colorGrey">30 by 30 is about as big as makes sense help</h6>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="toggle-container">
                        <button id="generator" class="toggle-option bgActive" onclick="onChangeView('generator')">Generator</button>
                        <button id="theme" class="toggle-option bgInActive" onclick="onChangeView('theme')">Theme</button>
                    </div>
                    <div>
                        <span class="font-weight-bold">How to make</span>&nbsp;
                        <span><i class="fa fa-play" style="color: #F01E76;" aria-hidden="true"></i></span>
                    </div>
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
                                        <input type="text" placeholder="word search with images" style="width: 100%;border-radius: 25px;border: 1px solid #fff;padding: 0 12px;">
                                    </div>
                                </div>
                                <div class="row mt-3 pl-3">
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-between align-items-center mb-3 dropdown-container">
                                            <h3 class="section-title mb-0">Select Word</h3>
                                            <select class="form-select fruits-select" onchange="onChangeType()">
                                                <option value="Fruit">Fruits</option>
                                                <option value="Flowers">Flowers</option>
                                                <option value="Animal">Animals</option>
                                            </select>
                                        </div>
                                        <div class="mt-2 h30">
                                            <div id="typeList" class="ml-3">
                                                <label class="word-label">
                                                    <input id="word1" type="checkbox" class="checkBox" onchange="onSelectWord('word1', 'Apple')">
                                                    <span>Apple</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word2" type="checkbox" class="checkBox" onchange="onSelectWord('word2', 'Banana')">
                                                    <span>Banana</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word3" type="checkbox" class="checkBox" onchange="onSelectWord('word3', 'Cranberry')">
                                                    <span>Cranberry</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word4" type="checkbox" class="checkBox" onchange="onSelectWord('word4', 'Blackcurrant')">
                                                    <span>Blackcurrant</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word5" type="checkbox" class="checkBox" onchange="onSelectWord('word5', 'Blueberry')">
                                                    <span>Blueberry</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word6" type="checkbox" class="checkBox" onchange="onSelectWord('word6', 'Avocados')">
                                                    <span>Avocados</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word7" type="checkbox" class="checkBox" onchange="onSelectWord('word7', 'Atemoya')">
                                                    <span>Atemoya</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word8" type="checkbox" class="checkBox" onchange="onSelectWord('word8', 'Rose apple/Water apple')">
                                                    <span>Rose apple/Water apple</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word9" type="checkbox" class="checkBox" onchange="onSelectWord('word9', 'Coconut')">
                                                    <span>Coconut</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word10" type="checkbox" class="checkBox" onchange="onSelectWord('word10', 'Finger lime')">
                                                    <span>Finger lime</span>
                                                </label>

                                                <label class="word-label">
                                                    <input id="word11" type="checkbox" class="checkBox" onchange="onSelectWord('word11', 'Cherimoya')">
                                                    <span>Cherimoya</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="font16w500">Written or Selected Words </p>
                                        <div class="mt-4 h30">
                                            <div id="selectedWords" class="ml-1 mt-2 font12w400">
                                                <ul>
                                                    <li>Use a comma or press enter between words.</li>
                                                    <li>Minimum word length: letters</li>
                                                    <li>word length: Maximum20 letters</li>
                                                    <li>Recommended number of words: 40</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-3 mb-4">
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
                                        <button class="btn_custom m-2 borderRadius bg-white borderOffPink w-75 cursorPointer" onclick="reset()">Reset</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn_custom m-2 borderRadius borderOffPink w-75 cursorPointer bgActive" onclick="onGenerateWorksheet()">Generate Worksheet</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END : Worksheet View -->
                            <!-- START : Theme View -->
                            <div id="themeView" style="display: none;">
                                <div class="p-2 row">
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme1')">
                                        <img id="theme1" class="themeImg" src="{{asset('/frontEnd/img/border-image1.jpg')}}">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme2')">
                                        <img id="theme2" class="themeImg" src="{{asset('/frontEnd/img/border-image2.png')}}">
                                    </div>

                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme3')">
                                        <img id="theme3" class="themeImg" src="{{asset('/frontEnd/img/border-image3.jpg')}}">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme4')">
                                        <img id="theme4" class="themeImg" src="{{asset('/frontEnd/img/border-image4.png')}}">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme5')">
                                        <img id="theme5" class="themeImg" src="{{asset('/frontEnd/img/border-image5.png')}}">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme6')">
                                        <img id="theme6" class="themeImg" src="{{asset('/frontEnd/img/border-image6.png')}}">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme7')">
                                        <img id="theme7" class="themeImg" src="{{asset('/frontEnd/img/border-image7.png')}}">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme8')">
                                        <img id="theme8" class="themeImg" src="{{asset('/frontEnd/img/border-image8.jpg')}}">
                                    </div>
                                    <div class="col-md-4 mt-2" onclick="onSelectTheme('theme9')">
                                        <img id="theme9" class="themeImg" src="{{asset('/frontEnd/img/border-image9.png')}}">
                                    </div>
                                </div>
                            </div>
                            <!-- END : Theme View -->
                        </div>
                    </div>
                    <div class="col-md-5 bgOffset d-flex flex-column mb-4" style="border-radius: 10px; height: 100%;">
                        <div class="p-3">
                            <p class="font16w500">Worksheet Preview</p>
                        </div>

                        <div class="pl-3 pr-3">
                            <div class="mt-3 borderRadius bg-white d-flex justify-content-center">
                                <button id="worksheet" class="btn_custom m-2 borderRadius bgActive pl-5 pr-5" onclick="onWorksheetPreviewChange('worksheet')">Worksheet</button>
                                <button id="answerkey" class="btn_custom m-2 borderRadius bgInActive pl-5 pr-5" onclick="onWorksheetPreviewChange('answerkey')">Answer Key</button>
                            </div>
                        </div>

                        <!-- Content Preview and Buttons -->
                        <div class="pl-3 pr-3 d-flex flex-column" style="flex-grow: 1;">
                            <!-- Preview Section -->
                            <div class="h30V2" style="flex-grow: 1; margin-top: 16px; overflow-y: auto;">
                                <div id="worksheetPreview" class="p-2 ml-1 mt-2 font12w400">
                                    <!-- Worksheet content will go here -->
                                </div>
                            </div>

                            <!-- Bottom Buttons -->
                            <div class="bgOffset">
                                <button class="btn_custom m-2 borderRadius bgPink borderOffPink text-white w-100">
                                    <img src="{{asset('/frontEnd/img/download-04.png')}}" alt="">&nbsp;
                                    Download Worksheet
                                </button>
                                <button class="btn_custom m-2 borderRadius bg-white borderOffPink w-100">
                                    <img src="./assets/img/download-04.png" alt="">&nbsp;
                                    Download Answer Key
                                </button>
                                <button class="btn_custom m-2 borderRadius bg-white borderOffPink w-100 cursorPointer" onclick="preview('previewModal')">
                                    Full Preview
                                </button>
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
{{--                                    <div class="row ml-2">--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <p class="font14w500Tab">Select Word</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <div class="d-flex justify-content-end">--}}
{{--                                                <select name="type" id="type" class="borderRadius borderGrey font-weight-bold clrPink p-2">--}}
{{--                                                    <option class="font12w400" value="Animal">Animal</option>--}}
{{--                                                    <option class="font12w400" value="Fruit">Fruit</option>--}}
{{--                                                    <option class="font12w400" value="Flowers">Flowers</option>--}}
{{--                                                    <option class="font12w400" value="Country">Country</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

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


    // function onSelectWord(id, word){
    //     var html = '';
    //
    //     if(document.getElementById(id).checked){
    //         this.selectedWordList.push(word)
    //     }else{
    //         this.selectedWordList = this.selectedWordList.filter(e => e != word);
    //     }
    //
    //     this.selectedWordList.forEach(e => {
    //         html += '<p class = "borderRadius borderGrey pl-2 pb-1 pt-1 w-50">'+e+'&nbsp; &nbsp;<i class = "fa fa-x cursorPointer" onclick="onUnSelectWord(\''+e+'\')"></i></p>';
    //     });
    //
    //     document.getElementById('selectedWords').innerHTML = html;
    // }
    //
    // function onUnSelectWord(word){
    //     var html = '';
    //
    //     this.selectedWordList = this.selectedWordList.filter(e => e != word);
    //
    //     this.selectedWordList.forEach(e => {
    //         html += '<p class = "borderRadius borderGrey pl-2 pb-1 pt-1 w-50">'+e+'&nbsp; &nbsp;<i class = "fa fa-x cursorPointer" onclick="onUnSelectWord(\''+e+'\')"></i></p>';
    //     });
    //
    //     document.getElementById('selectedWords').innerHTML = html;
    //     document.getElementById('word'+(this.words.indexOf(word)+1)).checked = false;
    // }


    function onSelectWord(id, word) {
        let html = '';

        if (document.getElementById(id).checked) {
            this.selectedWordList.push(word);
        } else {
            this.selectedWordList = this.selectedWordList.filter(e => e !== word);
        }

        this.selectedWordList.forEach(e => {
            html += `
            <button class="tag-btn mr-2 mb-2">
                ${e}
                <i class="fa fa-times ml-2" onclick="onUnSelectWord('${e}')"></i>
            </button>
        `;
        });

        document.getElementById('selectedWords').innerHTML = html;
    }

    function onUnSelectWord(word) {
        let html = '';

        this.selectedWordList = this.selectedWordList.filter(e => e !== word);

        this.selectedWordList.forEach(e => {
            html += `
            <button class="tag-btn mr-2 mb-2">
                ${e}
                <i class="fa fa-times ml-2" onclick="onUnSelectWord('${e}')"></i>
            </button>
        `;
        });

        document.getElementById('selectedWords').innerHTML = html;

        // Uncheck the original checkbox
        document.getElementById('word' + (this.words.indexOf(word) + 1)).checked = false;
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



    function onWorksheetPreviewChange(showAnswerKey) {
        const wordImagePairs = [
            { word: "ambulance", emoji: "🚑" },
            { word: "apple", emoji: "🍎" },
            { word: "animals", emoji: "🐱" }
        ];

        let html = '';
        html += `
        <div id="worksheetContent" class="p-3" >
            <h5 class="text-center mb-4">Matching Lists With Images</h5>
            <div class="row">
                <div class="col-6 font-weight-bold"> <!-- Words column -->
                    ${wordImagePairs.map(pair => `<p class="mb-3">${pair.word}</p>`).join('')}
                </div>
                <div class="col-6 text-right">
                    ${wordImagePairs.map(pair => `<p class="mb-3" style="font-size: 22px;">${pair.emoji}</p>`).join('')}
                </div>
            </div>
        </div>
    `;

        document.getElementById(id).innerHTML = html;
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

    function generateHtmlForWorksheet(id) {
        const wordImagePairs = [
            { word: "ambulance", emoji: "🚑" },
            { word: "apple", emoji: "🍎" },
            { word: "animals", emoji: "🐱" }
        ];

        let html = '';
        html += `
        <div id="worksheetContent" class="p-3" >
            <h5 class="text-center mb-4">Matching Lists With Images</h5>
            <div class="row">
                <div class="col-6 font-weight-bold"> <!-- Words column -->
                    ${wordImagePairs.map(pair => `<p class="mb-3">${pair.word}</p>`).join('')}
                </div>
                <div class="col-6 text-right">
                    ${wordImagePairs.map(pair => `<p class="mb-3" style="font-size: 22px;">${pair.emoji}</p>`).join('')}
                </div>
            </div>
        </div>
    `;

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