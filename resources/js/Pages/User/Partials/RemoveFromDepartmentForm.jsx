import SecondaryButton from "@/Components/SecondaryButton.jsx";
import { router, useForm } from "@inertiajs/react";

export default function RemoveFromDepartmentForm({
    className = "",
    user,
    department,
}) {
    const { data, delete: destroy } = useForm({
        user: user,
        department: department,
    });
    const submit = (e) => {
        e.preventDefault();
        console.log(true);
        console.log(user, department);
        data.user_id = user.user.id;

        destroy(route("departments.removeUser", department), {
            preserveScroll: true,
        });
    };

    return (
        <div>
            <input type={"hidden"} name={"user_id"} value={user.id} />
            <form method={"POST"} onSubmit={submit}>
                <SecondaryButton type={"submit"}>Remove</SecondaryButton>
            </form>
        </div>
    );
}
