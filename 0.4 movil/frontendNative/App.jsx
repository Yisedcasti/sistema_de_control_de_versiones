import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';

import Navbar from './src/navigation/navbar';
import { AuthProvider } from './src/Context/authContext';

const Stack = createNativeStackNavigator();

export default function App() {
  return (
    <AuthProvider>
      <NavigationContainer>
        <Stack.Navigator screenOptions={{ headerShown: false }}>
          <Stack.Screen name="Navegador" component={Navbar} />
        </Stack.Navigator>
      </NavigationContainer>
    </AuthProvider>
  );
}
