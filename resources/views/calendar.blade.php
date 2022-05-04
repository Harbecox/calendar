@extends('layout')

@section("content")
   <div class="container-fluid">
       <div class="c_table d-flex flex-wrap mb-5">
           <div class="cell day"></div>
           @foreach(range(0,6) as $day)
               <div class="cell day"><h4 class="text-center py-2">{{ \Illuminate\Support\Carbon::create(0,0,$day == 7 ? 0 : $day)->locale('en_US')->dayName }}</h4></div>
           @endforeach
           @foreach($calendar as $day)
               <div class="cell user">
                    <h4 class="px-2 py-2">{{ $day['user']->name }}</h4>
                    <img src="{{ $day['user']->avatar }}">
               </div>
               <div class="c_row">
                   @foreach(range(1,7) as $d)
                       <div class="border" data-left="{{ $d }}"></div>
                   @endforeach
                   @foreach($day['days'] as $task)
                       <div class="task" data-w="{{ $task->edow - $task->sdow + 1 }}" data-left="{{ $task->sdow }}">
                           <div @if($task->color) style="background-color: {{ $task->color }}" @else style="background-color: #ccc" @endif class="task_title">{{ $task->title }}</div>
                       </div>
                   @endforeach
               </div>
           @endforeach
       </div>
   </div>

    <style>
        .cell {
            flex: 12.5%;
            height: 210px;
        }

        .cell.day {
            height: auto;
        }

        .cell.user{
            text-align: center;
        }

        .cell.user img{
            width: 64px;
        }

        .c_row {
            flex: 87.5%;
            height: 210px;
            position: relative;
            outline: 1px solid #ccc;
        }

        .c_row .task {
            position: absolute;
            height: 30px;
            top: 0;
            padding: 2px;
            overflow: hidden;
            line-height: 28px;
        }

        .c_row .task .task_title {
            padding: 0 10px;
            font-weight: bold;
            border-radius: 5px;
        }

        .c_row .border {
            position: absolute;
            height: 100%;
        }

    </style>

    <script>
        let table = document.querySelector(".c_table");
        let cell_w = table.clientWidth / 8;
        let tasks = Array.from(document.querySelectorAll(".task"));
        tasks.forEach(function (task) {
            let w = parseInt(task.dataset.w);
            let l = parseInt(task.dataset.left);
            if(l + w > 7){
                w = 7 - l;
                task.dataset.w = w;
            }
            task.style.left = cell_w * l + 4 + "px";
            task.style.width = w * cell_w - 8;
        })

        let top_k = 30;

        document.querySelectorAll(".c_row").forEach(function (row_, index) {
            row_.querySelectorAll(".border").forEach(function (border) {
                border.style.left = border.dataset.left * cell_w;
            });
            tasks = Array.from(row_.querySelectorAll(".task"));
            let top_ = 0;
            while (tasks.length > 0) {
                let row = [0, 0, 0, 0, 0, 0, 0];
                let task = tasks.splice(0, 1)[0];
                row = punInRow(row, task);
                task.style.top = top_ + "px";
                for (let i = 0; i < tasks.length; i++) {
                    if (!tasks[i]) continue;
                    if (isRowEmpty(row, tasks[i])) {
                        // task = tasks.splice(i,1)[0];
                        task = tasks[i];
                        tasks[i] = null;
                        row = punInRow(row, task);
                        task.style.top = top_ + "px";
                    }
                }
                let tasks_ = [];
                for (let i = 0; i < tasks.length; i++) {
                    if (tasks[i]) {
                        tasks_.push(tasks[i]);
                    }
                }
                tasks = tasks_;
                top_ += top_k;
            }
        })


        function isRowEmpty(row, task) {
            if (task.innerText == "Butcher") {
                console.log(row, task);
            }
            let w = parseInt(task.dataset.w);
            let l = parseInt(task.dataset.left);
            let e = true;
            for (let i = l; i < (w + l); i++) {
                if (row[i] !== 0) {
                    e = false;
                }
            }
            return e;
        }

        function punInRow(row, task) {
            let w = parseInt(task.dataset.w);
            let l = parseInt(task.dataset.left);
            for (let i = l; i < (w + l); i++) {
                row[i] = 1;
            }
            return row;
        }


    </script>

@endsection
