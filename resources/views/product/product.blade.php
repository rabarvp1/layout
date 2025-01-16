<x-layout.layout>
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>product</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">+</button></a>
        </div>
        <div class="card-body">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form action="" class="vstack gap-3">
                                <label>name</label>
                                <input type="text" class="form-control">

                                <label>price</label>
                                <input type="text" class="form-control">

                                <label>stock</label>
                                <input type="text" class="form-control">

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
