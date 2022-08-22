<x-layout>

@include('particials._hero')
@include('particials._search')
    
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

@unless (count($listings) == 0)


    <!-- the listing is a associated array --> 
    @foreach($listings as $listing)    <!-- condiction use an at symbol --> 
        <x-listing-card :listing="$listing" />   <!--components-->

@endforeach  <!-- Tell the loop there is end -->  


@else

    <p>NO listings found!!</p>

@endunless

<div class="mt-6 p-4">{{$listings->links()}} </div> <!-- show the total number of pagings--> 


</div> 

</x-layout>