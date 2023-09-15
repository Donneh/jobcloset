import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import { useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function AddUserToDepartmentForm({
    className = "",
    department,
}) {
    const { data, setData, errors, post, reset } = useForm({
        email: "",
        // department_id: department.id,
    });

    const addUserToDepartment = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("department.addUser", department), {
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
                onSubmit={addUserToDepartment}
            >
                <div>
                    <InputLabel htmlFor="email" value="Email" />
                    <TextInput
                        className={"mt-1 block w-full"}
                        name={"email"}
                        id={"email"}
                        type={"email"}
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
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
