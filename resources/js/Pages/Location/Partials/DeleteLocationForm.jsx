import { useForm } from "@inertiajs/react";
import SecondaryButton from "@/Components/SecondaryButton.jsx";

export default function DeleteLocationForm({ className = "", location }) {
    const { post } = useForm({
        _method: "DELETE",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("locations.destroy", location), {
            preserveScroll: true,
        });
    };

    return (
        <div className={className}>
            <form onSubmit={submit}>
                <SecondaryButton type="submit">Delete</SecondaryButton>
            </form>
        </div>
    );
}
