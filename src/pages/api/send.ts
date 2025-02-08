import type { APIRoute } from "astro"
import { Resend } from "resend";

const resend = new Resend(import.meta.env.RESEND_API_KEY)

export const GET: APIRoute = async () => {

    // Send the email
    const { data, error } = await resend.emails.send({
        from: "Alfredo <adesigns7@gmail.com>",
        to: ["adesigns7@gmail.com"],
        subject: "Funciona ?",
        html: "<h1>Hello Email</h1>"
    })

    if (error) {
        return new Response(JSON.stringify(error));
    }

    return new Response(JSON.stringify(data));

}