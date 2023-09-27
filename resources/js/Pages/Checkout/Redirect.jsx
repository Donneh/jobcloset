import AdyenCheckout from "@adyen/adyen-web";
import "@adyen/adyen-web/dist/adyen.css";
import { useEffect, useRef } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { usePage } from "@inertiajs/react";

export default function Index({ redirectResult, sessionId }) {
    const { auth } = usePage().props;
    const paymentResult = useRef(null);

    const adyenConfig = {
        environment: "test",
        clientKey: "test_3DAUFMPMJJBOBKMSFWXW2T57ZA674CG3",
        analytics: {
            enabled: false,
        },
        session: {
            id: sessionId,
        },
        onPaymentCompleted: (result, component) => {
            paymentResult.current = result.resultCode;
            console.info(result, component);
        },
        onError: (error, component) => {
            console.error(error.name, error.message, error.stack, component);
        },
    };

    const initiateCheckout = async () => {
        const checkout = new AdyenCheckout(adyenConfig);

        (await checkout).submitDetails({
            details: { redirectResult: redirectResult },
        });
    };

    useEffect(() => {
        initiateCheckout();
    });

    return (
        <AuthenticatedLayout user={auth.user}>
            <div className="bg-white">
                <div className="mx-auto max-w-2xl px-4 pb-24 pt-8 sm:px-6 lg:max-w-7xl lg:px-8">
                    <h1>Result: {paymentResult.current}</h1>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
