// App.js
import React from 'react';
import { SafeAreaView, ScrollView, View, Text, Image, Button, TouchableOpacity, StyleSheet, FlatList } from 'react-native';
import EventosCarousel from '../components/eventosCarousel';
import NoticiasSection from '../components/Noticias';
import EquipoSection from '../components/Equipo';

export default function Layout() {
    return (
        <SafeAreaView style={styles.container}>
            <ScrollView>
                {/* Bienvenida */}
                <View style={styles.section}>
                    <Text style={styles.title}>BIENVENIDO A EDUFAST</Text>
                    <Image
                        source={require('../../assets/images/icon.png')}
                        style={styles.logo}
                        resizeMode="contain"
                    />
                </View>

                {/* Página */}
                <View style={styles.section}>
                    <Text style={styles.subtitle}>Vista Registro</Text>
                    <Text style={styles.text}>
                        Edufast es una plataforma diseñada para facilitar el acceso a información educativa. Dependiendo de tu rol tendrás diferentes funcionalidades. Intuitiva, fácil de usar y adaptada para cubrir diversas necesidades.
                    </Text>
                    <Image source={require("../../assets/images/paginaestudent.png")} style={styles.image} />
                </View>

                {/* Equipo */}
                <EquipoSection />
                <EventosCarousel />
                <NoticiasSection />

                

            </ScrollView>
        </SafeAreaView>
    );
}

// Estilos
const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#f7f7f7',
    },
    section: {
        padding: 20,
        marginBottom: 20,
        backgroundColor: '#fff',
    },
    logo: {
        width: 300,
        height: 150,
        alignSelf: 'center',
        marginVertical: 10,
    },
    title: {
        fontSize: 22,
        fontWeight: 'bold',
        textAlign: 'center',
        marginVertical: 5,
    },
    subtitle: {
        fontSize: 20,
        fontWeight: '600',
        marginBottom: 10,
        textAlign: 'center',
    },
    text: {
        fontSize: 16,
        marginBottom: 6,
        textAlign: 'center',
    },
    button: {
        backgroundColor: '#222',
        padding: 10,
        marginTop: 10,
        borderRadius: 8,
        alignSelf: 'center',
    },
    buttonText: {
        color: '#fff',
        fontSize: 16,
    },
    card: {
        marginVertical: 10,
        backgroundColor: '#e6e6e6',
        padding: 10,
        borderRadius: 10,
    },
    image: {
        width: '100%',
        height: 180,
        borderRadius: 10,
    },
});
