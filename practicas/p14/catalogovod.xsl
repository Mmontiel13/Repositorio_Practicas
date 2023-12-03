<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema" exclude-result-prefixes="xs" version="1.0">
    <xsl:output method="html" version="5.0" encoding="UTF-8" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Catalogo VOD</title>
                <link rel="stylesheet" type="text/css" href="estilos.css"/>
            </head>
            <body>
                <header>
                    <img src="logo.jpg" alt="Logo"/>
                </header>
                <main>
                    <h1>Catalogo VOD</h1>
                    <section>
                        <h2>PELICULAS</h2>
                        <table>
                            <tr>
                                <th>Titulo</th>
                                <th>Duración</th>
                                <th>Género</th>
                            </tr>
                            <xsl:apply-templates select="//peliculas/genero/titulo"/>
                        </table>
                    </section>
                    <section>
                        <h2>SERIES</h2>
                        <table>
                            <tr>
                                <th>Titulo</th>
                                <th>Duración</th>
                                <th>Género</th>
                            </tr>
                            <xsl:apply-templates select="//series/genero/titulo"/>
                        </table>
                    </section>
                </main>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="titulo">
        <tr>
            <td>
                <xsl:value-of select="."/>
            </td>
            <td>
                <xsl:value-of select="@duracion"/>
            </td>
            <td>
                <xsl:value-of select="../@nombre"/>
            </td>
        </tr>
    </xsl:template>
</xsl:stylesheet>
