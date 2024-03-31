@extends('layout.app')
@section('content')
<div id="game">
    <div class="drag-container"></div>
<div class="board">
  <div class="board-column todo">
    <div class="board-column-container">
      <div class="board-column-header">Todo</div>
      <div class="board-column-content-wrapper">
        <div class="board-column-content">
          <div class="board-item"><div class="board-item-content"><span>Item #</span>1</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>2</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>3</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>4</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>5</div></div>
        </div>
      </div>
    </div>
  </div>
  <div class="board-column working">
    <div class="board-column-container">
      <div class="board-column-header">Working</div>
      <div class="board-column-content-wrapper">
        <div class="board-column-content">
          <div class="board-item"><div class="board-item-content"><span>Item #</span>6</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>7</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>8</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>9</div></div>
          <div class="board-item"><div class="board-item-content"><span>Item #</span>10</div></div>
        </div>
      </div>
    </div>
  </div>
  <div class="board-column done">
    <div class="board-column-container">
      <div class="board-column-header">Done</div>
      <div class="board-column-content-wrapper">
        <div class="board-column-content">
          <div class="board-item" ><div class="board-item-content"><span>1</span></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<script>
 const app1 = {
        data(){
            return{
                errors: [],
                categories:[],
                message: '',
                words:[],
                titles:[],
                answ:[],

                right:[],
                wrong:[],
                games:[],

                gameCat:[],
            }
        },
        methods:{
            async getGames(){
                let response_categCat = await fetch('{{ route('getGames') }}');
                this.games = await response_categCat.json();
            },
            async getCategory(){
                let response_categ = await fetch('{{ route('gameCategoryGet') }}');
                this.categories = await response_categ.json();
                this.categories.forEach(element => {
                    element.forEach(elem => {
                        this.words.push(elem);
                    });
                });
                this.categories.forEach(element => {
                    this.titles.push(element[0].category)
                });
                console.log(this.words);
            },
            async getGameCat(){
                let response_categCat = await fetch('{{ route('getGameCat') }}');
                this.gameCat = await response_categCat.json();

            }
        },
        mounted(){
            this.getCategory();
            this.getGames();
            this.getGameCat();
        }
    }
    Vue.createApp(app1).mount('#game');
</script>
<style>
    * {
      box-sizing: border-box;
    }
    html, body {
      position: relative;
      width: 100%;
      height: 100%;
      font-family: Helvetica, Arial, sans-serif;
    }
    body {
      margin: 0;
      padding: 20px 10px;
    }
    .drag-container {
      position: fixed;
      left: 0;
      top: 0;
      z-index: 1000;
    }
    .board {
      position: relative;
    }
    .board-column {
      position: absolute;
      left: 0;
      top: 0;
      padding: 0 10px;
      width: calc(100% / 3);
      z-index: 1;
    }
    .board-column.muuri-item-releasing {
      z-index: 2;
    }
    .board-column.muuri-item-dragging {
      z-index: 3;
      cursor: move;
    }
    .board-column-container {
      position: relative;
      width: 100%;
      height: 100%;
    }
    .board-column-header {
      position: relative;
      height: 50px;
      line-height: 50px;
      overflow: hidden;
      padding: 0 20px;
      text-align: center;
      background: #333;
      color: #fff;
      border-radius: 5px 5px 0 0;
      font-weight: bold;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .board-column.todo .board-column-header {
      background: #4A9FF9;
    }
    .board-column.working .board-column-header {
      background: #f9944a;
    }
    .board-column.done .board-column-header {
      background: #2ac06d;
    }
    .board-column-content-wrapper {
      position: relative;
      padding: 8px;
      background: #f0f0f0;
      height: calc(40vh - 90px);
      overflow-y: auto;
      border-radius: 0 0 5px 5px;
    }
    .board-column-content {
      position: relative;
      min-height: 20%;
    }
    .board-item {
      position: absolute;
      width: calc(100% - 16px);
      margin: 8px;
    }
    .board-item.muuri-item-releasing {
      z-index: 9998;
    }
    .board-item.muuri-item-dragging {
      z-index: 9999;
      cursor: move;
    }
    .board-item.muuri-item-hidden {
      z-index: 0;
    }
    .board-item-content {
      position: relative;
      padding: 20px;
      background: #fff;
      border-radius: 4px;
      font-size: 17px;
      cursor: pointer;
      -webkit-box-shadow: 0px 1px 3px 0 rgba(0,0,0,0.2);
      box-shadow: 0px 1px 3px 0 rgba(0,0,0,0.2);
    }
    @media (max-width: 600px) {
      .board-item-content {
        text-align: center;
      }
      .board-item-content span {
        display: none;
      }
    }
    </style>
    <script>
     var dragContainer = document.querySelector('.drag-container');
    var itemContainers = [].slice.call(document.querySelectorAll('.board-column-content'));
    var columnGrids = [];
    var boardGrid;

    // Init the column grids so we can drag those items around.
    itemContainers.forEach(function (container) {
      var grid = new Muuri(container, {
        items: '.board-item',
        dragEnabled: true,
        dragSort: function () {
          return columnGrids;
        },
        dragContainer: dragContainer,
        dragAutoScroll: {
          targets: (item) => {
            return [
              { element: window, priority: 0 },
              { element: item.getGrid().getElement().parentNode, priority: 1 },
            ];
          }
        },
      })
      .on('dragInit', function (item) {
        item.getElement().style.width = item.getWidth() + 'px';
        item.getElement().style.height = item.getHeight() + 'px';
      })
      .on('dragReleaseEnd', function (item) {
        item.getElement().style.width = '';
        item.getElement().style.height = '';
        item.getGrid().refreshItems([item]);
      })
      .on('layoutStart', function () {
        boardGrid.refreshItems().layout();
      });

      columnGrids.push(grid);
    });

    // Init board grid so we can drag those columns around.
    boardGrid = new Muuri('.board', {
      dragEnabled: true,
      dragHandle: '.board-column-header'
    });
    </script>
@endsection
