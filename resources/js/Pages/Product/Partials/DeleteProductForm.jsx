import { useForm } from "@inertiajs/react";
import SecondaryButton from "@/Components/SecondaryButton.jsx";

export default function DeleteProductForm({ className = "", product }) {
    const { post } = useForm({
        _method: "DELETE",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("product.destroy", product), {
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
