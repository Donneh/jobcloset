import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import EditDepartmentForm from "@/Pages/Department/Partials/EditDepartmentForm.jsx";
import EditJobTitleForm from "@/Pages/JobTitle/Partials/EditJobTitleForm.jsx";

export default function Edit({ auth, mustVerifyEmail, status, jobTitle }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Job Title
                </h2>
            }
        >
            <Head title="Edit job title" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                Edit Job Title
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Edit job title details
                            </p>
                        </header>

                        <EditJobTitleForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            jobTitle={jobTitle}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
