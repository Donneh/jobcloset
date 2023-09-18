import SecondaryButton from "@/Components/SecondaryButton.jsx";
import { router, useForm } from "@inertiajs/react";

export default function RemoveFromLocationForm({
    className = "",
    user,
    location,
}) {
    const { data, delete: destroy } = useForm({
        user: user,
        location: location,
    });
    const submit = (e) => {
        e.preventDefault();
        data.user_id = user.user.id;

        destroy(route("locations.removeUser", location), {
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
