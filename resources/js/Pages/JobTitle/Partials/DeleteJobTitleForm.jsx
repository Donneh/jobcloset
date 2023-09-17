import { useForm } from "@inertiajs/react";
import SecondaryButton from "@/Components/SecondaryButton.jsx";

export default function DeleteJobTitleForm({ className = "", jobTitle }) {
    const { post } = useForm({
        _method: "DELETE",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("job-titles.destroy", jobTitle), {
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
