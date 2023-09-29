import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";

export default function Status({ paymentResult }) {
    if (paymentResult === "Authorised") {
        paymentResult = "Payment successful";
    } else {
        paymentResult = "Payment failed";
    }

    return (
        <AuthenticatedLayout>
            <div className="bg-white">
                <div className="mx-auto max-w-2xl px-4 pb-24 pt-8 sm:px-6 lg:max-w-7xl lg:px-8">
                    <h1>{paymentResult}</h1>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
