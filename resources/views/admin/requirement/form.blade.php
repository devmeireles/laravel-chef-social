<x-admin-layout>
    <div class="flex flex-col">
        <div class="flex flex-row justify-between">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-blue-600">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Admin
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{route('admin.requirement.list')}}"
                                class="ml-1 text-sm font-medium text-gray-800 hover:text-blue-600 md:ml-2">Requirements</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="#" class="ml-1 text-sm font-medium text-gray-800 hover:text-blue-600 md:ml-2">
                                {{isset($item) && $item ? $item->name : 'New Item'}}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="w-100 mt-12 block p-6 bg-white border border-gray-200 rounded-lg">
            <form method="post"
                action="{{isset($item) ? route('admin.requirement.update', $item->id) : route('admin.requirement.store')}}">
                @csrf

                <div class="w-8/12">
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Requirement Name</label>
                        <input type="text" id="name" name="name"
                            class="bg-stone-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="The requirement name" value="{{!empty($item->name) ? $item->name : old('name')}}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="slug" class="block mb-2 text-sm font-medium text-gray-900">Slug</label>
                        <input type="text" id="slug" name="slug"
                            class="bg-stone-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="The requirement name" readonly value="{{!empty($item->slug) ? $item->slug : old('slug')}}">
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="description" rows="4" name="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-stone-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="A short description about the requirement">{{!empty($item->description) ? $item->description : old('description')}}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <div class="w-8/12 flex mt-14">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>

                    <a href="{{route('admin.requirement.list')}}"
                        class="text-blue-600 border border-blue-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ml-10">Cancel</a>

                    @if(isset($item) && !$item->deleted_at)
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        class="text-red-600 border border-red-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ml-auto"
                        type="button">
                        Deactivate
                    </button>
                    @endif

                    @if(isset($item) && $item->deleted_at)
                    <a href="{{route('admin.requirement.reactivate', $item->id)}}"
                        class="text-indigo-600 border border-indigo-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ml-auto">
                        Reactivate
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if(isset($item))
    <div id="popup-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <form method="post" action="{{route('admin.requirement.destroy', $item->id)}}">
            @method('delete')
            @csrf
            <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                            deactivate {{$item->name}}?</h3>
                        <button data-modal-hide="popup-modal" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>

                        <button data-modal-hide="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif

    <script>
        // Get the input and output elements
        const nameInput = document.getElementById("name");
        const slugOutput = document.getElementById("slug");

        // Add an event listener to the input element
        nameInput.addEventListener("input", () => {
            // Get the value of the input element and normalize it
            const name = nameInput.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "");

            // Convert the normalized text to a slug string
            const slug = name.toLowerCase().replace(/[^a-zA-Z0-9]+/g, "-");

            // Update the value of the output element with the generated slug
            slugOutput.value = slug;
        });


    </script>
</x-admin-layout>