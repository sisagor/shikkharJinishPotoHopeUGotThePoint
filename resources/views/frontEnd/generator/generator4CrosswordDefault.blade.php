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
                    <h3 class="d-flex justify-content-center">Enter crossword puzzle content</h3>
                    <h6 class="d-flex justify-content-center colorGrey">Enter your words and definitions in the area provided, one word/definition pair per line of input.</h6>
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
                                        <p class="font16w500">Title</p>
                                        <div class="borderRadius bg-white">
                                            <input type="text" placeholder="Crossword Puzzle" style="width: 100%;border-radius: 25px;border: 1px solid #fff;padding: 0 12px;">
                                        </div>
                                    </div>
                                    <div class="row mt-3 pl-3">
                                        <div class="col-md-12">
                                            <form action="#">
                                                <h3 class="section-title mb-0">Write Words</h3>
                                                <textarea class="wordListTextarea" placeholder="Type or paste your list of words here&#10;Enter your words and definitions in the area provided, one word/definition pair per line of input.&#10;The answer word should be at the beginning of each line followed by a comma, and then followed by the word's clue. For example, the first two lines of your input might look as follows:&#10;Sun, the star at the center of our solar system&#10;Cat, a furry domesticated pet&#10;Tree, a tall plant with a trunk and branches" rows="10" cols="60"></textarea>

                                            </form>
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
                                        <img src="{{asset('/frontEnd/img/download-04.png')}}" alt="">&nbsp;
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