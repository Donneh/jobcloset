import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import { Head, useForm } from "@inertiajs/react";
import MainCard from "@/Components/MainCard.jsx";
import MainCardHeader from "@/Components/MainCardHeader.jsx";
import UpdateAdyenForm from "@/Pages/CompanySettings/Partials/UpdateAdyenForm.jsx";
export default function Index({ company }) {
    const { data, setData, post, errors } = useForm({
        adyen_merchant_account: "",
        adyen_api_key: "",
        adyen_client_key: "",
    });
    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("submit");
    };
    return (
        <AuthenticatedLayout pageTitle={"Company settings"}>
            <MainCard>
                <MainCardHeader title="Company Settings" />

                <UpdateAdyenForm company={company} />
            </MainCard>
        </AuthenticatedLayout>
    );
}
