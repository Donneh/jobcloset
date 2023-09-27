import AdyenCheckout from "@adyen/adyen-web";
import "@adyen/adyen-web/dist/adyen.css";
import { useEffect, useRef } from "react";

export default function Index({ sessionId, sessionData }) {
    const paymentContainer = useRef(null);
    const adyenConfig = {
        environment: "test",
        clientKey: "test_3DAUFMPMJJBOBKMSFWXW2T57ZA674CG3",
        analytics: {
            enabled: false,
        },
        session: {
            id: sessionId,
            sessionData: sessionData,
        },
        onPaymentCompleted: (result, component) => {
            console.info(result, component);
        },
        onError: (error, component) => {
            console.error(error.name, error.message, error.stack, component);
        },
    };

    const initiateCheckout = async () => {
        const checkout = new AdyenCheckout(adyenConfig);

        checkout
            .create("dropin", {
                onSubmit: (state, dropin) => {
                    dropin.setStatus("loading");
                    // makePaymentCall(state.data).then...
                },
                onAdditionalDetails: (state, dropin) => {
                    // makeDetailsCall(state.data).then...
                },
            })
            .mount(paymentContainer);
    };

    useEffect(() => {
        initiateCheckout();
    }, []);

    return (
        <div>
            <h1>Checkout</h1>
            <div ref={paymentContainer}></div>
        </div>
    );
}
