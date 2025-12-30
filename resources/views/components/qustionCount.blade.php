<div class="col-lg-3 border-start p-3 p-md-4 bg-light">



     <div class="d-flex align-items-center justify-content-between mb-3">
         <h6 class="mb-0">Navigator</h6>
         <div class="d-flex gap-1">
             <span class="badge bg-success">Saved</span>
             <span class="badge bg-warning text-dark">Marked</span>
         </div>
     </div>
     <div class="row g-2">

    

         @for($i=0; $i<=19; $i++)
         
             <div class="col-3">
                 <button data-index="{{$i}}" class="btn btn-sm w-100 btn-outline-secondary {{ in_array($i, $savedquestion) ? 'active-saved' : '' }} {{ in_array($i, $questioncount) ? 'active-marked' : '' }} change-question">{{$i+1}}</button>
             </div>
         @endfor
     </div>
 </div>