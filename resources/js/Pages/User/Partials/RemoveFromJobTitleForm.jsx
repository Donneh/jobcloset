import SecondaryButton from "@/Components/SecondaryButton.jsx";
import { router, useForm } from "@inertiajs/react";

export default function RemoveFromJobTitleForm({
    className = "",
    user,
    jobTitle,
}) {
    const { data, delete: destroy } = useForm({
        user: user,
        jobTitle: jobTitle,
    });
    const submit = (e) => {
        e.preventDefault();
        data.user_id = user.user.id;

        destroy(route("job-titles.removeUser", jobTitle), {
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
