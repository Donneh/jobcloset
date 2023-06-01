import {useRef} from "react";
import {useForm} from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import {Transition} from "@headlessui/react";
import TextareaInput from "@/Components/TextareaInput.jsx";
import FileInput from "@/Components/FileInput.jsx";

export default function CreateProductForm({ className = '' }) {
    const nameInput = useRef();
    const priceInput = useRef();
    const descriptionInput = useRef();
    const stockInput = useRef();
    const imageInput = useRef();

    const { data, setData, errors, post, reset, processing, recentlySuccessful } = useForm({
        name: '',
        price: '',
        description: '',
        stock: '',
        image: '',
    });

    const createProduct = (e) => {
        e.preventDefault();

        post(route('product.store'), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: (errors) => {
                if (errors.name) {
                    reset('name');
                    nameInput.current.focus();
                }

                if (errors.price) {
                    reset('price');
                    priceInput.current.focus();
                }

                if (errors.description) {
                    reset('description');
                    descriptionInput.current.focus();
                }

                if (errors.stock) {
                    reset('stock');
                    stockInput.current.focus();
                }

                if (errors.image) {
                    reset('image');
                    imageInput.current.focus();
                }
            },
        });
    }

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Create Product</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Create a new product.
                </p>
            </header>

            <form onSubmit={createProduct} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="name" value="Name" />

                    <TextInput
                        id="name"
                        ref={nameInput}
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="price" value="Price" />

                    <TextInput
                        id="price"
                        ref={priceInput}
                        value={data.price}
                        onChange={(e) => setData('price', e.target.value)}
                        type="number"
                        min="1"
                        step="any"
                        className="mt-1 block w-full"
                    />

                    <InputError message={errors.price} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="description" value="Description" />

                    <TextareaInput
                        id="description"
                        ref={descriptionInput}
                        value={data.description}
                        onChange={(e) => setData('description', e.target.value)}
                        className="mt-1 block w-full"
                    />

                    <InputError message={errors.description} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="stock" value="Stock" />

                    <TextInput
                        id="stock"
                        ref={stockInput}
                        value={data.stock}
                        onChange={(e) => setData('stock', e.target.value)}
                        type="number"
                        min="0"
                        step="1"
                        className="mt-1 block w-full"
                    />

                    <InputError message={errors.stock} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="image" value="Image" />

                    <FileInput
                        id="image"
                        ref={imageInput}
                        value={data.image}
                        onChange={(e) => setData('image', e.target.value)}
                        className="mt-1 block w-full"
                    />

                    <InputError message={errors.image} className="mt-2" />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing} type="submit">Save</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition-opacity duration-500"
                        enterFrom="opacity-0"
                        enterTo="opacity-100"
                        leave="transition-opacity duration-500"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                    >
                        <span className="text-green-500">Saved!</span>
                    </Transition>
                </div>
            </form>
        </section>
    )
}
