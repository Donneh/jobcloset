import React, { useRef, useState } from "react";
import { Link, useForm } from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { Transition } from "@headlessui/react";
import TextareaInput from "@/Components/TextareaInput.jsx";
import FileInput from "@/Components/FileInput.jsx";
import SecondaryButton from "@/Components/SecondaryButton.jsx";
import Modal from "@/Components/Modal.jsx";
import ProductVariantForm from "@/Pages/Product/ProductVariantForm.jsx";

export default function CreateProductForm({ className = "" }) {
    const {
        data,
        setData,
        errors,
        post,
        progress,
        reset,
        processing,
        recentlySuccessful,
    } = useForm({
        name: "",
        price: "",
        description: "",
        stock: "",
        image: "",
        variants: "",
    });

    const [isVariantModalOpen, setVariantModalOpen] = useState(false);
    const [variantFormData, setVariantFormData] = useState([]);

    const handleVariantFormSubmit = (data) => {
        setVariantFormData([...variantFormData, data]);
        setVariantModalOpen(false);
    };

    const handleVariantDelete = (index) => {
        const newVariantData = [...variantFormData];
        newVariantData.splice(index, 1);
        setVariantFormData(newVariantData);
    };

    const createProduct = (e) => {
        e.preventDefault();

        setData("variants", variantFormData);

        console.log(data);
        post(route("products.store"), {
            preserveScroll: true,
            onSuccess: () => reset(),
            forceFormData: true,
        });
    };

    return (
        <section className={`bg-white text-black ${className}`}>
            <form
                onSubmit={createProduct}
                className="mt-6 space-y-6"
                encType={"multipart/form-data"}
            >
                <div>
                    <InputLabel htmlFor="name" value="Name" />

                    <TextInput
                        id="name"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="description" value="Description" />

                    <TextareaInput
                        id="description"
                        value={data.description}
                        onChange={(e) => setData("description", e.target.value)}
                        className="mt-1 block w-full"
                    />

                    <InputError message={errors.description} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="image" value="Image" />

                    <input
                        type={"file"}
                        onChange={(e) => setData("image", e.target.files[0])}
                        name={"image"}
                    />
                    {progress > 0 && (
                        <progress value={progress.percentage}>
                            {progress.percentage}%
                        </progress>
                    )}

                    <InputError message={errors.image} className="mt-2" />
                </div>
                {data.image && (
                    <img
                        src={URL.createObjectURL(data.image)}
                        alt={data.name}
                    />
                )}
                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing} type="submit">
                        Save
                    </PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition-opacity duration-500"
                        enterFrom="opacity-0"
                        enterTo="opacity-100"
                        leave="transition-opacity duration-500"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                    >
                        <span className="text-gray-800">Saved!</span>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
