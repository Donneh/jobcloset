import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import { useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import Select from "react-select";

export default function AddUserToLocationForm({
    className = "",
    location,
    users,
}) {
    const userData = users.map((user) => {
        return {
            value: user.id,
            label: user.email,
        };
    });
    const { data, setData, errors, post, reset } = useForm({
        user_id: "",
    });

    const addUserToLocation = (e) => {
        e.preventDefault();
        post(route("locations.addUser", location), {
            preserveScroll: true,
            onSuccess: () => reset(),
            forceFormData: true,
        });
    };
    return (
        <section className={className}>
            <form
                className="mt-6 space-y-6"
                method={"POST"}
                onSubmit={addUserToLocation}
            >
                <div>
                    <InputLabel htmlFor="user_id" value="Email" />
                    <Select
                        options={userData}
                        name={"user_id"}
                        onChange={(e) => {
                            setData("user_id", e.value);
                        }}
                    />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton
                        type="submit"
                        className={
                            "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        }
                    >
                        Add User
                    </PrimaryButton>
                </div>
            </form>
        </section>
    );
}
