import { useForm } from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { Transition } from "@headlessui/react";

export default function CreateLocationForm({ className = "" }) {
    const {
        data,
        setData,
        errors,
        post,
        reset,
        processing,
        recentlySuccessful,
    } = useForm({
        name: "",
    });

    const createLocation = (e) => {
        e.preventDefault();

        post(route("locations.store"), {
            preserveScroll: true,
            onSuccess: () => reset(),
            forceFormData: true,
        });
    };

    return (
        <section className={className}>
            <form
                onSubmit={createLocation}
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
