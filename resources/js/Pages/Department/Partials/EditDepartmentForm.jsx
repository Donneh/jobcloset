import { useRef } from "react";
import { useForm } from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { Transition } from "@headlessui/react";
import TextareaInput from "@/Components/TextareaInput.jsx";
import FileInput from "@/Components/FileInput.jsx";

export default function EditDepartmentForm({ className = "", department }) {
    const {
        data,
        setData,
        errors,
        post,
        reset,
        processing,
        recentlySuccessful,
    } = useForm({
        name: department.name,
        _method: "PATCH",
    });

    const saveProduct = (e) => {
        e.preventDefault();

        post(route("department.update", department), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: (errors) => {
                Object.keys(errors).forEach((key) => {
                    reset(key);
                });
            },
        });
    };

    return (
        <section className={className}>
            <form onSubmit={saveProduct} className="mt-6 space-y-6">
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
                        <span className="text-green-500">Saved!</span>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
