<form action="{{route('filter.text')}}"  enctype="multipart/form-data" method="POST" >
    @csrf
<input type="file" name="fileText" >
<button>upload </button>

</form>
